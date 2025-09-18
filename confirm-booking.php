<?php
session_start();

// Get submitted data
$offerId       = $_POST['offerId'] ?? null;
$selectedOffer = $_SESSION['flights'][$offerId] ?? null;

if (!$selectedOffer) {
    die("❌ Invalid flight selection.");
}

// Passenger Info
$firstNames  = $_POST['first-name'] ?? [];
$middleNames = $_POST['middle-name'] ?? [];
$lastNames   = $_POST['last-name'] ?? [];
$genders     = $_POST['gender'] ?? [];
$dob         = $_POST['dob'] ?? [];

// Billing Info
$address1 = $_POST['address1'] ?? '';
$address2 = $_POST['address2'] ?? '';
$country  = $_POST['country'] ?? '';
$state    = $_POST['state'] ?? '';
$city     = $_POST['city'] ?? '';
$zip      = $_POST['zip'] ?? '';

// Contact Info
$contact_info_phone = $_POST['phone'] ?? '';
$contact_inf_email = $_POST['email'] ?? '';

// --- Build passengers array in Amadeus format ---
$passengers = [];
for ($i = 0; $i < count($firstNames); $i++) {
    $passengers[] = [
        "id" => (string)($i+1),
        "dateOfBirth" => !empty($dob[$i]) ? date("Y-m-d", strtotime($dob[$i])) : "2000-01-01",
        "name" => [
            "firstName" => ucfirst(trim($firstNames[$i])),
            "lastName"  => ucfirst(trim($lastNames[$i]))
        ],
        "gender" => strtoupper($genders[$i] ?? "MALE"),
        "contact" => [
            "emailAddress" => $contact_inf_email,
            "phones" => [[
                "deviceType" => "MOBILE",
                "countryCallingCode" => "91", // ⚠️ adjust dynamically if needed
                "number" => $contact_info_phone
            ]]
        ],
        "documents" => [[
            "documentType"    => "PASSPORT",
            "number"          => "X1234567",       // placeholder
            "expiryDate"      => "2030-01-01",     // placeholder
            "issuanceCountry" => strtoupper($country ?: "IN"),
            "nationality"     => strtoupper($country ?: "IN"),
            "holder"          => true
        ]]
    ];
}

// Save to session for finalize-booking.php
$_SESSION['passengers'] = $passengers;
$_SESSION['billing'] = [
    "address1" => $address1,
    "address2" => $address2,
    "country"  => $country,
    "state"    => $state,
    "city"     => $city,
    "zip"      => $zip
];
$_SESSION['contact'] = [
    "phone" => $contact_info_phone,
    "email" => $contact_inf_email
];

function getCurrencySymbol($currency) {
    $symbols = [
        "USD" => "$", "EUR" => "€", "GBP" => "£", "INR" => "₹",
        "AED" => "د.إ", "JPY" => "¥", "CNY" => "¥", "CAD" => "C$",
        "AUD" => "A$", "CHF" => "CHF",
    ];
    return $symbols[$currency] ?? $currency;
}

// 🔑 Amadeus API credentials
$client_id     = "IMewQoGGzsLuxu2vR2r9ImKFeRVNbf4m";
$client_secret = "bLW0u8zhqigZYcaC";

// ✅ Get Access Token
function getAmadeusToken($client_id, $client_secret) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://test.api.amadeus.com/v1/security/oauth2/token");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        "grant_type"    => "client_credentials",
        "client_id"     => $client_id,
        "client_secret" => $client_secret
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return $data["access_token"] ?? null;
}

$token = getAmadeusToken($client_id, $client_secret);

// ✅ Fetch Airport Full Name
function getAirportName($iataCode, $token) {
    static $airportCache = [];

    if (isset($airportCache[$iataCode])) {
        return $airportCache[$iataCode];
    }

    $url = "https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT&keyword=" . urlencode($iataCode);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($res, true);
    $airportName = $data["data"][0]["name"] ?? $iataCode;
    $airportCache[$iataCode] = $airportName;

    return $airportName;
}

// ✅ Fetch Airline Full Name (Amadeus Dictionary or local mapping)
function getAirlineName($carrierCode) {
    $airlines = [
        "AI" => "Air India",
        "UK" => "Vistara",
        "6E" => "IndiGo",
        "SG" => "SpiceJet",
        "G8" => "Go First",
        "EK" => "Emirates",
        "QR" => "Qatar Airways",
        "BA" => "British Airways",
        "LH" => "Lufthansa",
        // ➕ add more codes as needed
    ];
    return $airlines[$carrierCode] ?? $carrierCode;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Confirmation</title>
  <?php include("header.php") ?>
  <style>
    body { background:#f9f9f9; }
    
    .confirm-heading { font-size:22px; font-weight:600; margin-bottom:15px; }
    .success-msg { font-size:20px; font-weight:600; color:#28a745; }
  </style>

<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8">
        <div class="booking-review-card">
          <h3 class="wrap-subhding_web1 text-success pt-0 pb-2">✅ Your booking details have been received!</h3>
          <P class="wrap-prgh_web1">Please review the summary below before proceeding to payment.</P>
        </div>
        <h3 class="wrap-subhding_web1 pt-4 pb-3">Flight Details</h3>
        <?php if ($selectedOffer): ?>
        <div class="confirm-box">
            <?php foreach ($selectedOffer["itineraries"] as $itinerary): ?>
              <?php
                $segments  = $itinerary["segments"];
                $firstSeg  = $segments[0];
                $lastSeg   = $segments[count($segments)-1];

                $depTime   = date("h:i A", strtotime($firstSeg["departure"]["at"]));
                $arrTime   = date("h:i A", strtotime($lastSeg["arrival"]["at"]));
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
                $airlineName = getAirlineName($airlineCode);

                $depAirportCode = $firstSeg["departure"]["iataCode"];
                $arrAirportCode = $lastSeg["arrival"]["iataCode"];

                $depAirportFull = getAirportName($depAirportCode, $token);
                $arrAirportFull = getAirportName($arrAirportCode, $token);

                $logoUrl = "https://static.tripcdn.com/packages/flight/airline-logo/latest/airline_logo/3x/" . strtolower($airlineCode) . ".webp";

                $stops = count($segments) - 1;
              ?>
            <div class="row align-items-center mb-3">
                <div class="col-md-auto">
                    <div class="d-flex d-md-block align-items-center gap-3 mb-2 mb-md-0">
                        <img src="<?= $logoUrl ?>" width="50" alt="<?= $airlineCode ?>">
                        <p class="flight-logo-name">
                             <?= htmlspecialchars($airlineName) ?> 
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="flight-time"><?= $depTime ?></h5>
                            <p class="flight-location"><?= $depAirportFull ?> (<?= $depAirportCode ?>)</p>
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
                            <p class="flight-location"><?= $arrAirportFull ?> (<?= $arrAirportCode ?>)</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>


        <input type="hidden" name="adults" value="<?= $adults ?>" id="adults">
        <input type="hidden" name="children" value="<?= $children ?>" id="children">
        <input type="hidden" name="infants" value="<?= $infants ?>" id="infants">

        <!-- Passenger Info -->
        <div class="confirm-box">
            <h3 class="wrap-subhding_web1 pt-0 pb-3">Passenger Details</h3>
            <!--Start Desktop Design -->
            <div class="table-responsive d-none d-md-block">
                <table class="table passenger-table">
                    <thead>
                        <tr>
                            <th>Passenger</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($firstNames); $i++): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= htmlspecialchars($firstNames[$i]) ?> <?= htmlspecialchars($lastNames[$i]) ?></td>
                            <td><?= htmlspecialchars(strtoupper($genders[$i])) ?></td>
                            <td><?= htmlspecialchars($dob[$i]) ?></td>
                            <td>
                                <?php 
                                if (!empty($dob[$i])) {
                                    $dobDate = new DateTime($dob[$i]);
                                    $today   = new DateTime();
                                    $age     = $today->diff($dobDate)->y;
                                    echo $age;
                                } else {
                                    echo "-";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php endfor; ?>   
                    </tbody>
                </table>
            </div>
            <!--End Desktop Design -->
            
            <!--Start Mobile Design -->
            <?php for($i = 0; $i < count($firstNames); $i++): ?>
            <div class="passenger-mob-design d-block d-md-none">
                <div class="row">
                    <div class="col-auto">
                        <div class="passenger-mob-num"><?= $i+1 ?></div>
                    </div>
                    <div class="col">
                        <div class="d-flex gap-3">
                            <p class="passenger-mob-name"><?= htmlspecialchars($firstNames[$i]) ?> <?= htmlspecialchars($lastNames[$i]) ?></p>
                            <p class="passenger-mob-gender">(<?= htmlspecialchars(strtoupper($genders[$i])) ?>)</p>
                        </div>    
                        <p class="passenger-mob-dob">
                            <?= htmlspecialchars($dob[$i]) ?> 
                            (<?php 
                                if (!empty($dob[$i])) {
                                    $dobDate = new DateTime($dob[$i]);
                                    $today   = new DateTime();
                                    $age     = $today->diff($dobDate)->y;
                                    echo $age;
                                } else {
                                    echo "-";
                                }
                                ?>)
                        </p>
                    </div>
                </div>
            </div>
            <?php endfor; ?>   
            <!--Start Mobile Design -->

        </div>

        <!-- Billing Info -->
        <div class="confirm-box">
            <h3 class="wrap-subhding_web1 pt-0 pb-3">Billing Information</h3>
            <p class="wrap-prgh_web1 pb-1"><span class="summary-label">Address:</span> <?= htmlspecialchars($address1.' '.$address2) ?></p>
            <p class="wrap-prgh_web1 pb-1"><span class="summary-label">City:</span> <?= htmlspecialchars($city) ?>, <?= htmlspecialchars($state) ?></p>
            <p class="wrap-prgh_web1 pb-1"><span class="summary-label">Country:</span> <?= htmlspecialchars($country) ?></p>
            <p class="wrap-prgh_web1 pb-1"><span class="summary-label">Zip Code:</span> <?= htmlspecialchars($zip) ?></p>
        </div>

        <!-- Contact Info -->
        <div class="confirm-box">
            <h3 class="wrap-subhding_web1 pt-0 pb-3">Contact Information</h3>
            <p class="wrap-prgh_web1 pb-1"><span class="summary-label">Phone:</span> <?= htmlspecialchars($contact_info_phone) ?></p>
            <p class="wrap-prgh_web1 pb-1"><span class="summary-label">Email:</span> <?= htmlspecialchars($contact_inf_email) ?></p>
        </div>

      </div>
      <div class="col-md-12 col-lg-4">
        <div class="confirm-box confirm-box-position">
            <h3 class="wrap-subhding_web1 pt-0">Fare Summary</h3>
            <hr>
            <ul class="fare-summary-list">
                <li>
                    <span>Base Fare</span>
                    <span><?= getCurrencySymbol($selectedOffer["price"]["currency"]) . " " . $selectedOffer["price"]["total"] ?></span>
                </li>
                <li>
                    <span>Taxes & Fees</span>
                    <span>0.00</span>
                </li>
                <li>
                    <span>Total Price</span>
                    <span><?= getCurrencySymbol($selectedOffer["price"]["currency"]) . " " . $selectedOffer["price"]["total"] ?></span>
                </li>
            </ul>
            <a href="payment.php?offerId=<?= urlencode($offerId) ?>" class="wrap-btn_web1 bg-success border-success mt-4 mx-auto d-table">Proceed to Secure Payment</a>

            <p class="wrap-prgh_web1 mt-3 text-muted text-center"><small><strong>Payment Notice</strong>: Your seat is reserved for a limited time. Please complete the payment to confirm your booking.</small></p>
        </div>
      </div>
      <div class="col-md-12">
          <h2 class="policy-wrap-hding pb-2">🛄 Baggage Allowance</h2>
          <ul class="ullist_web1">
              <li>Cabin Baggage: Each passenger is allowed 1 piece of hand baggage (maximum 7 kg / 15 lbs, dimensions 55cm x 35cm x 25cm).</li>
              <li>Check-in Baggage: Standard allowance is 1 piece up to 23 kg (50 lbs) per passenger. Additional baggage may incur extra charges.</li>
          </ul>
          <p class="wrap-prgh_web1 text-muted"><small>Note: Baggage policies may vary by airline. Please review your ticket for exact details.</small></p>

          <h2 class="policy-wrap-hding pb-2">❌ Cancellation & Refund Policy</h2>
          <ul class="ullist_web1">
              <li>All cancellations are subject to the airline’s fare rules and conditions.</li>
              <li>Once payment is completed, bookings are subject to the airline’s cancellation and refund rules.</li>
              <li>Refunds (if applicable) may take 7–14 business days to process.</li>
              <li>Some fares may be non-refundable or subject to cancellation fees.</li>
              <li>Date or time changes may be permitted by the airline, subject to rebooking fees and fare differences.</li>
              <li>For full details, please review our <a href="canellation-and-refund-policy.php" target="_blak">Cancellation & Refund Policy</a>.</li>
          </ul>

          <h2 class="policy-wrap-hding pb-2">🍴 Special Requests</h2>
          <p class="wrap-prgh_web1 text-muted">We strive to make your journey comfortable. You may request:</p>
          <ul class="ullist_web1">
              <li>Meals: Vegetarian, Vegan, Jain, Gluten-free, or Special Dietary Meals (subject to airline availability).</li>
              <li>Assistance: Wheelchair, Medical support, or Priority boarding.</li>
              <li>Other Services: Seat preference, Infant/child assistance, or Extra legroom (subject to airline policy and availability).</li>
          </ul>
          <p class="wrap-prgh_web1 text-muted">Please inform us at least 48 hours prior to departure to confirm special requests.</p>
      </div>
    </div>
  </div>
</section>

<?php include("footer.php") ?>