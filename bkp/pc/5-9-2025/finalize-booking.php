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
    die("❌ Failed to get Amadeus access token");
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
  <title>Booking Confirmation</title>

<?php include("header.php") ?>

  <style>
    body { background:#f9f9f9; }
    .success-msg { font-size:22px; font-weight:600; color:#28a745; }
  </style>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="text-center mb-4">
        <div class="success-msg">✅ Payment Successful & Booking Confirmed!</div>
        <p class="text-muted">Your booking has been created with <?php echo $domainname_web ?>.</p>
      </div>

      <div class="confirm-box">
        <h4 class="text-center">Confirmation ID: <?= htmlspecialchars($confirmationId) ?></h4>
        <p class="text-center"><strong>Total Paid:</strong> <?= getCurrencySymbol($selectedOffer["price"]["currency"]) . " " . $selectedOffer["price"]["total"] ?>
        </p>
      </div>


      <div class="confirm-box">
        <h5>Passenger(s)</h5>
        <ul>
          <?php foreach ($passengers as $p): ?>
            <li><?= htmlspecialchars($p['name']['firstName'] . " " . $p['name']['lastName']) ?> (<?= htmlspecialchars($p['gender']) ?>)</li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="confirm-box">
        <h5>Flight Details</h5>
        <?php foreach ($selectedOffer["itineraries"] as $itin): ?>
          <?php 
            $firstSeg = $itin["segments"][0];
            $lastSeg  = $itin["segments"][count($itin["segments"])-1];
          ?>
          <p><strong>Route:</strong> <?= htmlspecialchars($firstSeg["departure"]["iataCode"]) ?> → <?= htmlspecialchars($lastSeg["arrival"]["iataCode"]) ?></p>
          <p><strong>Time:</strong> <?= date("h:i A", strtotime($firstSeg["departure"]["at"])) ?> → <?= date("h:i A", strtotime($lastSeg["arrival"]["at"])) ?></p>
        <?php endforeach; ?>
      </div>
    </div>  
  </div>  
</div>
</body>
</html>
