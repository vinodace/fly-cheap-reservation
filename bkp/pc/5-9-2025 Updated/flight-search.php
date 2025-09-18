<?php
session_start(); 

// =====================
// Amadeus API Credentials
// =====================
$client_id     = "IMewQoGGzsLuxu2vR2r9ImKFeRVNbf4m";
$client_secret = "bLW0u8zhqigZYcaC";

// =====================
// Function: Get Access Token
// =====================
function getAccessToken($client_id, $client_secret) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://test.api.amadeus.com/v1/security/oauth2/token");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        "grant_type"    => "client_credentials",
        "client_id"     => $client_id,
        "client_secret" => $client_secret
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        die("❌ Token Request Error: " . curl_error($ch));
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if (!isset($data["access_token"])) {
        die("❌ Failed to get access token. Response:<br><pre>" . print_r($data, true) . "</pre>");
    }

    return $data["access_token"];
}

// =====================
// Collect Form Inputs
// =====================
$origin_code      = $_GET['origin_code'] ?? '';
$origin_name      = $_GET['origin_name'] ?? '';
$destination_code = $_GET['destination_code'] ?? '';
$destination_name = $_GET['destination_name'] ?? '';

$origin         = strtoupper(trim($_GET['origin'] ?? ''));
$destination    = strtoupper(trim($_GET['destination'] ?? ''));
$departure_date = $_GET['departure_date'] ?? '';
$return_date    = $_GET['return_date'] ?? '';
$trip_type      = $_GET['tripType'] ?? 'oneway';
$travel_class   = strtoupper($_GET['travel_class'] ?? 'Economy');
$adults         = (int)($_GET['adults'] ?? 1);
$children       = (int)($_GET['children'] ?? 0);
$infants        = (int)($_GET['infants'] ?? 0);

$total_passengers = $adults + $children + $infants;
$passenger_summary = $total_passengers . ' Passenger' . ($total_passengers > 1 ? 's' : '') . ' - ' . $travel_class;

// =====================
// Get Token
// =====================
$token = getAccessToken($client_id, $client_secret);

// =====================
// Build Flight Search URL
// =====================
$url = "https://test.api.amadeus.com/v2/shopping/flight-offers?";
$params = [
    "originLocationCode"      => $origin,
    "destinationLocationCode" => $destination,
    "departureDate"           => $departure_date,
    "adults"                  => $adults,
    "travelClass"             => $travel_class,
    "currencyCode"            => "USD",
    "max"                     => 50 // Flight search Limit
];
if ($trip_type === "roundtrip" && !empty($return_date)) {
    $params["returnDate"] = $return_date;
}
if ($children > 0) $params["children"] = $children;
if ($infants > 0)  $params["infants"]  = $infants;

$url .= http_build_query($params);

// =====================
// Call Amadeus API
// =====================
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer " . $token]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    die("❌ API Request Error: " . curl_error($ch));
}

curl_close($ch);

$results = json_decode($response, true);

// =====================
// Helper: Currency Symbols
// =====================
function getCurrencySymbol($currency) {
    $symbols = [
        "USD" => "$", "EUR" => "€", "GBP" => "£", "INR" => "₹",
        "AED" => "د.إ", "JPY" => "¥", "CNY" => "¥", "CAD" => "C$",
        "AUD" => "A$", "CHF" => "CHF",
    ];
    return $symbols[$currency] ?? $currency;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Flights</title>

<?php include("header.php"); ?>

<!-- Flight search result with waiting loader modal -->
<section class="flight-search-result-bg">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="flight-search-box mb-4 flight-search-box-neg_mt">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="flight" role="tabpanel" aria-labelledby="flight-tab">
               
                <form id="flightForm" action="flight-search.php"  method="GET">
                  <div class="row">
                    <div class="col-sm-12 mb-2">
                      <div class="form-group">
                          <label><input type="radio" class="choose-trip-type" name="tripType" value="oneway" <?= ($trip_type === "oneway") ? "checked" : "" ?>> One Way</label>
                          <label><input type="radio" class="choose-trip-type" name="tripType" value="roundtrip" <?= ($trip_type === "roundtrip") ? "checked" : "" ?>> Round Trip</label>
                      </div>    
                    </div>
                    <div class="col-md-5">
                      <div class="row">
                        <div class="col-sm-6 col-md-6 pe-md-0">
                          <div class="form-group" id="citySection">
                            <label class="filter-lbl">Leaving From</label>
                            <input type="text" class="filter-field from_oneway1 field-right-radius-0" id="fromAirport" placeholder="From" value="<?= htmlspecialchars($_GET['origin_name'] ?? '') ?> (<?= htmlspecialchars($_GET['origin'] ?? '') ?>)"  required>
                            <input type="hidden" id="fromAirportCode" name="origin" value="<?= htmlspecialchars($_GET['origin'] ?? '') ?>">    <!-- IATA Code -->
                            <input type="hidden" id="fromAirportName" name="origin_name" value="<?= htmlspecialchars($_GET['origin_name'] ?? '') ?>">   <!-- Full Name -->
                          </div> 
                        </div>
                        <div class="col-sm-6 col-md-6 px-md-0">
                          <div class="form-group" id="citySection">
                            <label class="filter-lbl">Going To</label>
                            <input type="text" class="filter-field to_oneway1 field-radius-0" id="toAirport" placeholder="To" value="<?= htmlspecialchars($_GET['destination_name'] ?? '') ?> (<?= htmlspecialchars($_GET['destination'] ?? '') ?>)" required>
                            <input type="hidden" id="toAirportCode" name="destination" value="<?= htmlspecialchars($_GET['destination'] ?? '') ?>"> <!-- IATA Code -->
                            <input type="hidden" id="toAirportName" name="destination_name" value="<?= htmlspecialchars($_GET['destination_name'] ?? '') ?>"> <!-- Full Name -->
                          </div>
                        </div>    
                      </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-2 px-md-0">
                      <div class="form-group">
                         <label class="filter-lbl">Departure Date</label>
                          <input type="text" class="filter-field field-radius-0" id="departDate" name="departure_date" placeholder="Select date" value="<?= $departure_date ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-2 px-md-0">
                      <div class="form-group">   
                          <label class="filter-lbl">Return Date</label> 
                          <input type="text" class="filter-field field-radius-0" name="return_date" id="returnDate" placeholder="Select date" value="<?= !empty($return_date) ? htmlspecialchars($return_date) : '' ?>" <?= ($trip_type === "roundtrip" && !empty($return_date)) ? '' : 'disabled' ?>>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3 ps-md-0">
                      <div class="form-group">
                          <label class="filter-lbl">Passenger & Class</label>
                          <div class="filter-field field-left-radius-0" id="passengerClassDisplay">
                            <?= htmlspecialchars($passenger_summary) ?>
                          </div>
                          <input type="hidden" name="passenger" id="passenger">

                          <div class="dropdown-panel" id="passengerDropdown">
                            <!-- Adults -->
                            <div class="traveller-row">
                              <input type="hidden" name="adults" id="adults" value="<?= $adults ?>">
                              <span>Adults <span>(12y+)</span></span>
                              <div>
                                <button type="button" class="count-btn" onclick="changeCount('adult', -1)">-</button>
                                <span class="passenger-count-output" id="adultCount"><?= $adults ?></span>
                                <button type="button" class="count-btn" onclick="changeCount('adult', 1)">+</button>
                              </div>
                            </div>

                            <!-- Children -->
                            <div class="traveller-row">
                              <input type="hidden" name="children" id="children" value="<?= $children ?>">
                              <span>Children <span>(2y - 12y)</span></span>
                              <div>
                                <button type="button" class="count-btn" onclick="changeCount('child', -1)">-</button>
                                <span class="passenger-count-output" id="childCount"><?= $children ?></span>
                                <button type="button" class="count-btn" onclick="changeCount('child', 1)">+</button>
                              </div>
                            </div>

                            <!-- Infants -->
                            <div class="traveller-row">
                              <input type="hidden" name="infants" id="infants" value="<?= $infants ?>">
                              <span>Infants <span>(Below 2y)</span></span>
                              <div>
                                <button type="button" class="count-btn" onclick="changeCount('infant', -1)">-</button>
                                <span class="passenger-count-output" id="infantCount"><?= $infants ?></span>
                                <button type="button" class="count-btn" onclick="changeCount('infant', 1)">+</button>
                              </div>
                            </div>

                            <!-- Travel Class -->
                            <div class="form-group mt-3">
                              <label class="travel-class-lbl">Choose Travel Class</label>
                              <select class="form-control" id="travelClass" onchange="updateCabinClass()">
                                <option value="Economy" <?= $travel_class=="Economy" ? "selected" : "" ?>>Economy</option>
                                <option value="Business" <?= $travel_class=="Business" ? "selected" : "" ?>>Business</option>
                                <option value="First" <?= $travel_class=="First" ? "selected" : "" ?>>First Class</option>
                              </select>
                              <input type="hidden" name="travel_class" id="cabin_class" value="<?= $travel_class ?>">
                            </div>

                            <div class="mt-3 text-end">
                              <button type="button" class="btn btn-primary btn-sm" onclick="confirmPassengers()">Confirm</button>
                            </div>
                          </div>
                      </div>
                      <!-- Total passenger and traveller updat  value -->

                    </div>
                    <div class="col-sm-12">
                      <div class="d-flex justify-content-md-end">
                        <button type="submit" name="submit" class="wrap-btn_web1 mx-auto mx-md-0 d-table"><i class="fa-solid fa-magnifying-glass"></i> Search Flights</button>
                      </div>  
                    </div>
                  </div>
                
                </form>

                <script>
                    // make sure tripTypeRadios and returnDateInput exist before using them
                    const tripTypeRadios = document.querySelectorAll('input[name="tripType"]');
                    const returnDateInput = document.getElementById('returnDate');
                    tripTypeRadios.forEach(radio => {
                        radio.addEventListener('change', () => {
                            if (radio.value === 'roundtrip') {
                                returnDateInput.readOnly = false; 
                            } else {
                                returnDateInput.readOnly = true;  
                                returnDateInput.value = '';       
                            }
                        });
                    });

                    // Initial state
                    if (document.querySelector('input[name="tripType"]:checked') && document.querySelector('input[name="tripType"]:checked').value !== 'roundtrip') {
                        if(returnDateInput) returnDateInput.readOnly = true;
                    }
                
                </script>

              </div>
            </div>
        </div>
      </div>

      <!-- Start waiting loader modal-->
      
      <div class="w-100"></div>
      <!-- End Waiting loader modal -->

      <div class="col-md-3">
        <div class="package-filter-box_web1 pb-2 sticky-sidebar">
          
          <div class="pfb_padding_web1">
            <h3 class="wrap-subhding_web1 pt-0">Airlines</h3>
            <ul class="pfb_checklist_web1">
                <?php if (!empty($results["dictionaries"]["carriers"])): ?>
                    <?php foreach ($results["dictionaries"]["carriers"] as $code => $name): ?>
                        <?php 
                            $logoUrl = "https://static.tripcdn.com/packages/flight/airline-logo/latest/airline_logo/3x/" . strtolower($code) . ".webp";
                            $checkboxId = strtolower(str_replace(' ', '_', $name));
                        ?>
                        <li>
                            <label for="<?= $checkboxId ?>">
                                <img src="<?= $logoUrl ?>" class="filter-airline-logo" alt="<?= $name ?>">
                                <?= htmlspecialchars($name) ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No airlines available.</li>
                <?php endif; ?>
            </ul>
            <hr>
            

            <h3 class="wrap-subhding_web1 pt-0">Recommended</h3>
            <ul class="pfb_checklist_web1">
              <li>
                <label for="checked_baggage_included">Checked baggage included</label>
              </li>
              <li>
                <label for="hide_budget_airlines">Hide budget airlines</label>
              </li>
              <li>
                <label for="carry-on_baggage_included">Carry-on baggage included</label>
              </li>
              <li>
                <label for="hide_codeshare_flights">Hide codeshare flights</label>
              </li>
            </ul>
            <hr>
            
            <h3 class="wrap-subhding_web1 pt-0">Stop</h3>
            <ul class="pfb_checklist_web1">
              <li>
                <label for="nonstop">Nonstop</label>
              </li>
              <li>
                <label for="1_stop">1 Stop or fewer</label>
              </li>
              <li>
                <label for="2_stop">2 Stopr or fewer</label>
              </li>
            </ul>
          </div>  
        </div>
      </div>
      <div class="col-md-9">
        <?php 
          $limit = 30; // Number of flights to show initially
          $count = 0;
        ?>
        <?php if (!empty($results["data"])): ?>
            <?php foreach ($results["data"] as $offer): ?>
                <?php $count++; ?>
                <?php $modalId = 'stopsModal' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $offer['id']); ?>
                <div class="flight-result-box <?= $count > $limit ? 'd-none extra-flight' : '' ?>">
                    <div class="row">
                        <!-- Flight Details -->
                        <div class="col-md-9">
                            <?php foreach ($offer["itineraries"] as $itinIndex => $itinerary): ?>
                                <?php 
                                    $segments = $itinerary["segments"];
                                    $firstSeg = $segments[0];
                                    $lastSeg  = end($segments);

                                    $depTime = date("h:i A", strtotime($firstSeg["departure"]["at"]));
                                    $arrTime = date("h:i A", strtotime($lastSeg["arrival"]["at"]));
                                    $depAirport = $firstSeg["departure"]["iataCode"];
                                    $arrAirport = $lastSeg["arrival"]["iataCode"];

                                    // duration
                                    $depDT = strtotime($firstSeg["departure"]["at"]);
                                    $arrDT = strtotime($lastSeg["arrival"]["at"]);
                                    $durationMin = round(($arrDT - $depDT)/60);
                                    $hrs = floor($durationMin / 60);
                                    $mins = $durationMin % 60;
                                    $duration = "{$hrs}h {$mins}m";

                                    // airline
                                    $airlineCode = $firstSeg["carrierCode"];
                                    $airlineName = $results["dictionaries"]["carriers"][$airlineCode] ?? $airlineCode;
                                    $logoUrl = "https://static.tripcdn.com/packages/flight/airline-logo/latest/airline_logo/3x/" . strtolower($airlineCode) . ".webp";

                                    $stops = count($segments) - 1;
                                ?>
                                <div class="row align-items-center mb-3">
                                    <div class="col-md-3">
                                        <div class="d-flex d-md-block align-items-center gap-3 mb-2 mb-md-0">
                                            <img src="<?= $logoUrl ?>" width="50" alt="<?= $airlineCode ?>">
                                            <p class="flight-logo-name">
                                                <?= ucwords(strtolower($airlineName)) ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <h5 class="flight-time"><?= $depTime ?></h5>
                                                <p class="flight-location"><?= $depAirport ?></p>
                                            </div>
                                            <div class="col-4">
                                                <div class="flight-result-duration">
                                                    <?= $duration ?>
                                                    <div class="flight-duration-line"></div>
                                                    <?php if ($stops > 0): ?>
                                                        <small class="text-muted"><?= $stops ?> Stop<?= $stops > 1 ? "s" : "" ?></small>
                                                    <?php else: ?>
                                                        <small class="text-muted">Non-stop</small>
                                                    <?php endif; ?>
                                                </div>    
                                            </div>
                                            <div class="col-4">
                                                <h5 class="flight-time"><?= $arrTime ?></h5>
                                                <p class="flight-location"><?= $arrAirport ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if (count($offer["itineraries"]) > 1 && $itinIndex == 0): ?>
                                    <hr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>

                        <!-- Price & Select -->
                        <div class="col-md-3 d-lg-flex flex-column justify-content-center text-center">
                            <div class="d-flex d-mb-block flex-column justify-content-between justify-content-md-center text-md-center">
                                <div>
                                    <a href="#" class="flight-price">
                                        <?= getCurrencySymbol($offer["price"]["currency"]) . " " . $offer["price"]["total"] ?>
                                    </a>
                                    <p class="wrap-prgh_web1 text-muted"><?= ucfirst($offer["type"]) ?> Ticket</p>
                                </div>
                                <?php 
                                  $_SESSION['flights'][$offer['id']] = $offer; 
                                ?>
                                <a href="booking.php?offerId=<?= urlencode($offer['id']) ?>" class="wrap-btn_web1 bg-info border-info mt-0">Select</a>
                            </div>
                            <a href="javascript:void(0)" class="wrap-prgh_web1 text-center d-block text-primary pt-1" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">Itinerary</a>
                        </div>
                    </div>
                </div>

                <!-- Modal for Stops (per offer) -->
                <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Stopover Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php foreach ($offer['itineraries'] as $iIndex => $itinerary): ?>
                          <h6>Itinerary <?= $iIndex + 1 ?></h6>
                          <ul class="list-group mb-3">
                            <?php foreach ($itinerary['segments'] as $segIndex => $seg): ?>
                              <?php
                                $airlineCode = $seg["carrierCode"];
                                $airlineName = $results["dictionaries"]["carriers"][$airlineCode] ?? $airlineCode;
                                $depAirport = $seg["departure"]["iataCode"] ?? '';
                                $depTime = isset($seg["departure"]["at"]) ? date("h:i A", strtotime($seg["departure"]["at"])) : '';
                                $arrAirport = $seg["arrival"]["iataCode"] ?? '';
                                $arrTime = isset($seg["arrival"]["at"]) ? date("h:i A", strtotime($seg["arrival"]["at"])) : '';
                              ?>
                              <li class="list-group-item">
                                <div><strong><?= htmlspecialchars($depAirport) ?> (<?= $depTime ?>) → <?= htmlspecialchars($arrAirport) ?> (<?= $arrTime ?>)</strong></div>
                                <div>Carrier: <?= htmlspecialchars($airlineName) ?> (<?= htmlspecialchars($airlineCode) ?>)</div>
                              </li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                </div>

            <?php endforeach; ?>
            <!-- Show More button -->
            <?php if ($count > $limit): ?>
                <div class="text-center mt-3">
                    <button id="showMoreBtn" class="wrap-btn_web1">Show More Flights</button>
                </div>
            <?php endif; ?>
          <?php else: ?>
            <!-- No flights found / waiting UI -->
              <div class="col-sm-12 col-md-12 mb-5" id="waiting-loader">
                <div class="search-form-box package-filter-box_web1">
                  <div class="d-flex justify-content-center align-items-center gap-4 pb-4">
                    <div class="w-50">
                      <p class="search-form-title text-center">Leaving From</p>
                      <h1 class="search-form-name text-center"><?= htmlspecialchars($origin_name) ?></h1>
                      <p class="wrap-prgh_web1 text-center text-info"><?php echo $origin ?></p>
                    </div>  
                    <h1 class="search-form-to text-center"> TO</h1>
                    <div class="w-50">
                      <p class="search-form-title text-center">Going To</p>
                      <h1 class="search-form-name text-center"><?= htmlspecialchars($destination_name) ?></h1>
                      <p class="wrap-prgh_web1 text-center text-info"><?php echo $destination ?></p>
                    </div>  
                  </div>
                  <ul class="search-form-list">
                    <li>Departure Date: <?php echo $departure_date ?></li>
                    <?php 
                      if (!empty($return_date)) {
                          echo "<li>Return Date: {$return_date}</li>";
                      }
                    ?>
                  </ul>
                  <p class="wrap-prgh_web1 text-center pt-2">Prices shown are per guest, inclusive of taxes and port fees. Additional baggage fees may apply.</p>
                  <h2 class="wait-hding pt-4">Please Wait...</h2>
                  <p class="wrap-prgh_web1 text-center fw-bold">We are Searching Airline Fares For You From Over 450 + Airlines</p>

                  <img src="images/loader.gif" alt="loader" class="search-form-loader">
                  <p class="wrap-prgh_web1 text-center">Still searching... Have questions? Our experts are just a call away</p>
                  <a href="tel:<?php echo $phone_web; ?>" class="search-form-callbtn"><i class="fa-solid fa-phone-volume"></i> Call Us <?php echo $phone_web; ?></a>
                </div>
              
              </div>

          <?php endif; ?>
      </div>

    </div>
  </div>
</section>



<script>
document.addEventListener("DOMContentLoaded", function(){
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
});
</script>
<?php include("footer.php"); ?>


<!-- show only total passenger -->
<script>
 document.addEventListener('DOMContentLoaded', () => {
    const displayBox = document.getElementById('passengerClassDisplay');
    const dropdownPanel = document.getElementById('passengerDropdown');
    const travelSelect = document.getElementById('travelClass');

    const counts = {
        adult: parseInt(document.getElementById('adults').value) || 1,
        child: parseInt(document.getElementById('children').value) || 0,
        infant: parseInt(document.getElementById('infants').value) || 0
    };

    function updateDisplay() {
        const travelClass = travelSelect.value;
        const totalPassengers = counts.adult + counts.child + counts.infant;
        displayBox.textContent = `${totalPassengers} Passenger${totalPassengers>1?'s':''} - ${travelClass}`;
        document.getElementById('adults').value = counts.adult;
        document.getElementById('children').value = counts.child;
        document.getElementById('infants').value = counts.infant;
        document.getElementById('cabin_class').value = travelClass;
        document.getElementById('passenger').value = `${totalPassengers} Passenger${totalPassengers>1?'s':''} - ${travelClass}`;
    }

    function changeCount(type, delta) {
        if (counts[type] + delta >= 0) {
            counts[type] += delta;
            document.getElementById(type + 'Count').textContent = counts[type];
        }
    }

    document.querySelectorAll(".count-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            const type = this.dataset.type;
            const delta = parseInt(this.dataset.delta);
            changeCount(type, delta);
        });
    });

    displayBox.addEventListener('click', () => {
        dropdownPanel.style.display = dropdownPanel.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', e => {
        if (!e.target.closest('#passengerDropdown') && !e.target.closest('#passengerClassDisplay')) {
            dropdownPanel.style.display = 'none';
        }
    });

    document.getElementById('confirmPassengerBtn')?.addEventListener('click', () => {
        updateDisplay();
        dropdownPanel.style.display = 'none';
    });

    travelSelect.addEventListener('change', updateDisplay);

    updateDisplay(); // initialize summary
});
</script>


<!-- Flight airport list autocomplete -->
<script>
// 🔑 Amadeus API credentials
const client_id = "IMewQoGGzsLuxu2vR2r9ImKFeRVNbf4m";
const client_secret = "bLW0u8zhqigZYcaC";

// Get Amadeus access token
async function getAccessToken() {
  const res = await fetch("https://test.api.amadeus.com/v1/security/oauth2/token", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({
      grant_type: "client_credentials",
      client_id: client_id,
      client_secret: client_secret
    })
  });
  const data = await res.json();
  return data.access_token;
}

// Setup autocomplete
function setupAutocomplete(inputId, hiddenCodeId, hiddenNameId) {
  getAccessToken().then(token => {
    
    $("#" + inputId).autocomplete({
      minLength: 2, // user can start typing earlier
      source: function(request, response) {
        fetch(`https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT,CITY&keyword=${request.term}&page[limit]=20`, {
          headers: { "Authorization": "Bearer " + token }
        })
        .then(res => res.json())
        .then(data => {
          if (!data.data) return response([]);
          response(data.data.map(airport => {
            const city = airport.address?.cityName || airport.name;
            return {
              label: `${airport.name} (${airport.iataCode}) - ${city}, ${airport.address?.countryName || ""}`,
              value: `${airport.name} (${airport.iataCode})`, // show nice text in input
              code: airport.iataCode,   // store IATA in hidden field
              name: airport.name        // store airport name in hidden field
            };
          }));
        })
        .catch(() => response([]));
      },
      select: function(event, ui) {
        $("#" + inputId).val(ui.item.value);      // show full name in input
        $("#" + hiddenCodeId).val(ui.item.code);  // save IATA code
        $("#" + hiddenNameId).val(ui.item.name);  // save airport name
        return false;
      }
    });
  });
}

// Apply autocomplete
$(document).ready(function() {
  setupAutocomplete("fromAirport", "fromAirportCode", "fromAirportName");
  setupAutocomplete("toAirport", "toAirportCode", "toAirportName");
});
</script>


<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="js/countries.js"></script>

<!-- Datepicker of departure date differnt from home page code because in this code when data fetched from one way departure date then select round trip and choose return date then it will not take previous date from departure date -->

<script>
$(function () {
    // Departure date picker
    $("#departDate").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0,
        numberOfMonths: 2,
        onSelect: function (selectedDate) {
            // Set minDate for return date
            $("#returnDate").datepicker("option", "minDate", selectedDate);

            // If roundtrip, auto-show return calendar
            if ($('input[name="tripType"]:checked').val() === 'roundtrip') {
                setTimeout(function () {
                    $("#returnDate").datepicker("show");
                }, 200);
            }
        }
    });

    // Return date picker
    $("#returnDate").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0,
        numberOfMonths: 2
    });

    // Trip type toggle
    $('input[name="tripType"]').on('change', function () {
        if ($(this).val() === 'roundtrip') {
            $("#returnDate").prop("disabled", false);

            // Enforce min return date if departure already selected
            const departVal = $("#departDate").val();
            if (departVal) {
                $("#returnDate").datepicker("option", "minDate", departVal);

                // If current return < depart, reset it
                const returnVal = $("#returnDate").val();
                if (returnVal && returnVal < departVal) {
                    $("#returnDate").val(departVal);
                }
            }
        } else {
            $("#returnDate").prop("disabled", true).val("");
        }
    });

    // Initial state check
    if ($('input[name="tripType"]:checked').val() !== 'roundtrip') {
        $("#returnDate").prop("disabled", true);
    }
});
</script>




<script>
function changeCount(type, change) {
  let countEl, hiddenEl;
  if(type === 'adult') {
    countEl = document.getElementById('adultCount');
    hiddenEl = document.getElementById('adults');
  } else if(type === 'child') {
    countEl = document.getElementById('childCount');
    hiddenEl = document.getElementById('children');
  } else {
    countEl = document.getElementById('infantCount');
    hiddenEl = document.getElementById('infants');
  }

  let current = parseInt(countEl.innerText);
  let newVal = current + change;
  if(newVal < 0) newVal = 0;
  countEl.innerText = newVal;
  hiddenEl.value = newVal;
}

function updateCabinClass() {
  document.getElementById('cabin_class').value = document.getElementById('travelClass').value;
}

function confirmPassengers() {
  let adults = parseInt(document.getElementById('adults').value);
  let children = parseInt(document.getElementById('children').value);
  let infants = parseInt(document.getElementById('infants').value);
  let cls = document.getElementById('cabin_class').value;

  let summary = [];
  if(adults > 0) summary.push(adults + " " + (adults > 1 ? "Adults" : "Adult"));
  if(children > 0) summary.push(children + " " + (children > 1 ? "Children" : "Child"));
  if(infants > 0) summary.push(infants + " " + (infants > 1 ? "Infants" : "Infant"));

  document.getElementById('passengerClassDisplay').innerText = summary.join(", ") + " - " + cls.charAt(0).toUpperCase() + cls.slice(1).toLowerCase();

  // Close dropdown
  document.getElementById('passengerDropdown').style.display = "none";
}
</script>


<!-- reveal hidden flights on show more flight button -->
<script>
document.getElementById("showMoreBtn")?.addEventListener("click", function () {
    let hiddenFlights = document.querySelectorAll(".extra-flight.d-none");
    hiddenFlights.forEach(el => el.classList.remove("d-none"));
    this.style.display = "none"; // hide button after showing all
});
</script>

<!-- Bootstrap 5 + Popper (ensure modal works). If your header/footer already includes these, you can remove these lines. -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
