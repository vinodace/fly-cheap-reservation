<?php
session_start();

// 1. Get offer and passenger details from session
$offerId       = $_POST['offerId'] ?? null;
$selectedOffer = $_SESSION['flights'][$offerId] ?? null;
$passengers    = $_SESSION['passengers'] ?? []; // stored earlier in confirm-booking.php

if (!$selectedOffer || empty($passengers)) {
    die("❌ Missing booking data. Please restart your booking.");
}

// 2. Simulate payment validation
$cardHolder  = $_POST['card_holder'] ?? '';
$cardNumber  = $_POST['card_number'] ?? '';
$expiryMonth = $_POST['expiry_month'] ?? '';
$expiryYear  = $_POST['expiry_year'] ?? '';
$cvv         = $_POST['cvv'] ?? '';

// 🚨 In test mode we just simulate
$paymentSuccess = true; 

if (!$paymentSuccess) {
    die("❌ Payment failed. Please try again.");
}

// 3. Get Amadeus Access Token via cURL
$client_id     = "IMewQoGGzsLuxu2vR2r9ImKFeRVNbf4m";
$client_secret = "bLW0u8zhqigZYcaC";

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

$tokenData = json_decode($response, true);
$token = $tokenData['access_token'] ?? null;

if (!$token) {
    die("❌ Failed to get access token");
}

// 4. Call Amadeus Flight Orders API via cURL
$bookingPayload = [
    "data" => [
        "type" => "flight-order",
        "flightOffers" => [$selectedOffer],
        "travelers"    => $passengers
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://test.api.amadeus.com/v1/booking/flight-orders");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $token",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($bookingPayload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$orderResponse = curl_exec($ch);
curl_close($ch);

$order = json_decode($orderResponse, true);

// 5. Generate confirmation number
$confirmationId = $order['data']['id'] ?? strtoupper(uniqid("CONF-"));

// Save booking to session
$_SESSION['order'] = $order;


// ✅ Currency Helper
function getCurrencySymbol($currency) {
    $symbols = [
        "USD" => "$", "EUR" => "€", "GBP" => "£", "INR" => "₹",
        "AED" => "د.إ", "JPY" => "¥", "CNY" => "¥", "CAD" => "C$",
        "AUD" => "A$", "CHF" => "CHF",
    ];
    return $symbols[$currency] ?? $currency;
}

// ✅ Airline Name Helper
function getAirlineName($carrierCode, $token) {
    static $airlineCache = [];

    if (isset($airlineCache[$carrierCode])) {
        return $airlineCache[$carrierCode];
    }

    $url = "https://test.api.amadeus.com/v1/reference-data/airlines?airlineCodes=" . urlencode($carrierCode);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($res, true);
    $airlineName = $data["data"][0]["businessName"] ?? $carrierCode;

    $airlineCache[$carrierCode] = $airlineName;
    return $airlineName;
}

// ✅ Airport Name Helper
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Booking Confirmation</title>

<?php include("header.php") ?>

  <style>
    body { background:#f9f9f9; }

  </style>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="text-center mb-4">
        <div class="success-msg">✅ Payment Successful & Booking Confirmed!</div>
        <p class="text-muted">Your booking has been created with <?php echo $domainname_web ?>.</p>
      </div>
      <div class="d-flex justify-content-center gap-3 mt-3 mb-4">
        <button type="button" class="wrap-btn_web1" id="downloadBtn"><i class="fa-solid fa-download"></i> Download Ticket</button>  
        <button type="button" class="wrap-btn_web1 bg-white text-dark" id="printBtn">🖨️ Print</button>  
      </div> 
      <div class="print-area" id="printArea">
        <div class="confirm-box">
          <h4 class="text-center">Confirmation Booking ID: <?= htmlspecialchars($confirmationId) ?></h4>
          <p class="text-center"><strong>Total Paid:</strong> <?= getCurrencySymbol($selectedOffer["price"]["currency"]) ."". $selectedOffer["price"]["total"] ?>
          </p>
          <h5>Passenger(s)</h5>
          <ul class="finalize-passenger pb-4">
            <?php foreach ($passengers as $p): ?>
              <li><?= htmlspecialchars($p['name']['firstName'] . " " . $p['name']['lastName']) ?> <span>(<?= htmlspecialchars($p['gender']) ?>)</span></li>
            <?php endforeach; ?>
          </ul>  
          <h5 class="pb-2">Flight Details</h5>
          <div class="row justify-content-between align-items-start mb-3">
            <?php foreach ($selectedOffer["itineraries"] as $itin): ?>
              <?php 
                $firstSeg = $itin["segments"][0];
                $lastSeg  = $itin["segments"][count($itin["segments"])-1];
              ?>
              <div class="col-sm-4 mb-2">
                <p class="mb-0 wrap-prgh_web1"><strong>Route</strong><br> <?= htmlspecialchars($firstSeg["departure"]["iataCode"]) ?> → <?= htmlspecialchars($lastSeg["arrival"]["iataCode"]) ?></p>  
              </div>
              <div class="col-sm-4 mb-2">
                <div class="text-sm-center">
                  <p class="mb-0 wrap-prgh_web1"><strong>Time</strong><br> <?= date("h:i A", strtotime($firstSeg["departure"]["at"])) ?> → <?= date("h:i A", strtotime($lastSeg["arrival"]["at"])) ?></p>  
                </div>  
              </div>
              <div class="col-sm-4 mb-2">
                <div class="text-sm-end">
                  <p class="mb-0 wrap-prgh_web1"><strong>Date</strong><br> <?= date("d M, Y", strtotime($firstSeg["departure"]["at"])) ?> </p>  
                </div>  
              </div>
            <?php endforeach; ?>

            <!-- <p class="mb-0 wrap-prgh_web1"><strong>Date:</strong> <?= date("d M, Y") ?></p> -->
          </div>  



          <?php foreach ($selectedOffer["itineraries"] as $itin): ?>
          <?php foreach ($itin["segments"] as $seg): 
              $carrierCode   = $seg["carrierCode"]; // e.g., "EY"
              $flightNumber  = $seg["number"];      // e.g., "217"
              $depCode       = $seg["departure"]["iataCode"]; // e.g., DXB
              $arrCode       = $seg["arrival"]["iataCode"];   // e.g., JFK
              $depTime       = $seg["departure"]["at"];
              $arrTime       = $seg["arrival"]["at"];
              $depTerminal   = $seg["departure"]["terminal"] ?? '';
              $arrTerminal   = $seg["arrival"]["terminal"] ?? '';
              
              // Airline logo (free static CDN source)
              $airlineLogo = "https://static.tripcdn.com/packages/flight/airline-logo/latest/airline_logo/3x/" . strtolower($carrierCode) . ".webp";

              // Lookup full city/airport names via Amadeus dictionaries (if already stored, else hardcode mapping or call API)
              $depCity = $seg["departure"]["cityName"] ?? $depCode; 
              $arrCity = $seg["arrival"]["cityName"] ?? $arrCode;
          ?>
          <div class="finalize-ticket mb-4">
            <div class="finalize-ticket-left-half-circle"></div>
            <div class="finalize-ticket-right-half-circle"></div>

            <div class="finalize-ticket-header d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-3">
                <img src="<?= $airlineLogo ?>" class="finalize-ticket-logo" alt="<?= $carrierCode ?>">
                <p class="finalize-ticket-airline_name text-dark">
                  <?= getAirlineName($carrierCode, $token) ?> <br> 
                  <small class="text-muted"><?= htmlspecialchars($carrierCode . $flightNumber) ?></small>
                </p>
              </div>
              <div class="d-flex gap-2 align-items-center">
                <p class="finalize-ticket-airline_name text-danger"><?= $selectedOffer["travelerPricings"][0]["fareDetailsBySegment"][0]["cabin"] ?? "Economy" ?></p>
                <?php if ($depTerminal): ?>
                  <p class="finalize-ticket-airline_name text-dark bg-warning px-1"><small>T-<?= htmlspecialchars($depTerminal) ?></small></p>
                <?php endif; ?>
              </div>  
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h4 class="disc_flight_route"><?= $depCode ?></h4>
                <p class="disc_flight_route_name"><?= getAirportName($depCode, $token) ?></p>
                <p class="disc_flight_route_name"><small><?= date("d M, h:i A", strtotime($depTime)) ?></small></p>
              </div>
              <img src="images/airplane.png" class="disc_route_img">
              <div>
                <h4 class="disc_flight_route"><?= $arrCode ?></h4>
                <p class="disc_flight_route_name"><?= getAirportName($arrCode, $token) ?></p>
                <p class="disc_flight_route_name"><small><?= date("d M, h:i A", strtotime($arrTime)) ?></small></p>
                <!-- <?php if ($arrTerminal): ?>
                  <p class="text-muted small">Terminal <?= htmlspecialchars($arrTerminal) ?></p>
                <?php endif; ?> -->
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        <?php endforeach; ?>
        </div>
      </div>
      <p class="wrap-prgh_web1 text-muted text-center">
        <small>Thank you for booking with <?php echo $domainname_web ?>. Your flight ticket has been successfully issued. A copy of your e-ticket has been generated so you could download it and For Assistance, Please Contact Us: <a href="tel:<?php echo $phone_web ?>"><?php echo $phone_web ?></a></small>
      </p>
       
      <a href="./" class="text-center d-block wrap-prgh_web1 text-primary pt-4"><i class="fa-solid fa-arrow-left-long"></i> Back to Home</a>
      
    </div>  
  </div>  
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<script>
  // const printBtn = document.getElementById('printBtn');

  const downloadBtn = document.getElementById('downloadBtn');
const printArea = document.querySelector('.print-area');

downloadBtn.addEventListener('click', () => {
  const opt = {
    margin:       [10, 10, 10, 10],
    filename:     'booking-summary.pdf',
    image:        { type: 'jpeg', quality: 0.98 },
    html2canvas:  { scale: 2, useCORS: true },
    jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
    pagebreak:    { mode: ['avoid', 'css', 'legacy'] }
  };

  html2pdf().set(opt).from(printArea).save();
});





  // Pritn Screen

  document.getElementById('printBtn').addEventListener('click', () => {
  window.print(); // opens the browser print dialog
});
</script>

</body>
</html>
