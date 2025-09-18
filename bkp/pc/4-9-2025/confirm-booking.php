<?php
session_start();

// Get submitted data
$offerId = $_POST['offerId'] ?? null;
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
$phone_web = $_POST['phone'] ?? '';
$email_web = $_POST['email'] ?? '';

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
  <meta charset="UTF-8">
  <title>Booking Confirmation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#f9f9f9; }
    .confirm-box { background:#fff; padding:25px; border-radius:12px; box-shadow_web1:0 2px 6px rgba(0,0,0,0.1); margin-bottom:25px; }
    .confirm-heading { font-size:22px; font-weight:600; margin-bottom:15px; }
    .summary-label { font-weight:500; color:#555; }
    .success-msg { font-size:20px; font-weight:600; color:#28a745; }
  </style>
</head>
<body>
<div class="container py-5">

  <div class="text-center mb-4">
    <div class="success-msg">✅ Your booking details have been received!</div>
    <p class="text-muted">Please review the summary below before proceeding to payment.</p>
  </div>

  <!-- Passenger Info -->
  <div class="confirm-box">
    <div class="confirm-heading">Passenger Information</div>
    <?php for($i = 0; $i < count($firstNames); $i++): ?>
        <p><span class="summary-label">Passengre:</span> <?= $i+1 ?></p>
        <p><span class="summary-label">Name:</span> <?= htmlspecialchars($firstNames[$i]) ?> <?= htmlspecialchars($lastNames[$i]) ?></p>
        <p><span class="summary-label">Gender:</span> <?= htmlspecialchars($genders[$i]) ?></p>
        <p><span class="summary-label">Date of Birth:</span> <?= htmlspecialchars($dob[$i]) ?></p>
    <?php endfor; ?>    
  </div>

  <!-- Billing Info -->
  <div class="confirm-box">
    <div class="confirm-heading">Billing Information</div>
    <p><span class="summary-label">Address:</span> <?= htmlspecialchars($address1.' '.$address2) ?></p>
    <p><span class="summary-label">City:</span> <?= htmlspecialchars($city) ?>, <?= htmlspecialchars($state) ?></p>
    <p><span class="summary-label">Country:</span> <?= htmlspecialchars($country) ?></p>
    <p><span class="summary-label">Zip Code:</span> <?= htmlspecialchars($zip) ?></p>
  </div>

  <!-- Contact Info -->
  <div class="confirm-box">
    <div class="confirm-heading">Contact Information</div>
    <p><span class="summary-label">Phone:</span> <?= htmlspecialchars($phone_web) ?></p>
    <p><span class="summary-label">Email:</span> <?= htmlspecialchars($email_web) ?></p>
  </div>

  <!-- Flight Info -->
  <?php if ($selectedOffer): ?>
  <div class="confirm-box">
    <div class="confirm-heading">Selected Flight</div>
    <?php foreach ($selectedOffer["itineraries"] as $itinIndex => $itinerary): ?>
      <?php
        $segments  = $itinerary["segments"];
        $firstSeg  = $segments[0];
        $lastSeg   = $segments[count($segments)-1];

        $depTime   = date("h:i A", strtotime($firstSeg["departure"]["at"]));
        $arrTime   = date("h:i A", strtotime($lastSeg["arrival"]["at"]));
        $depAirport = $firstSeg["departure"]["iataCode"];
        $arrAirport = $lastSeg["arrival"]["iataCode"];

        $airlineCode = $firstSeg["carrierCode"];
        $airlineName = $dictionaries['carriers'][$airlineCode] ?? $airlineCode;
      ?>
      <p><span class="summary-label">Airline:</span> <?= htmlspecialchars($airlineName) ?> (<?= htmlspecialchars($airlineCode) ?>)</p>
      <p><span class="summary-label">Route:</span> <?= $depAirport ?> → <?= $arrAirport ?></p>
      <p><span class="summary-label">Time:</span> <?= $depTime ?> → <?= $arrTime ?></p>
    <?php endforeach; ?>
    <p><span class="summary-label">Price:</span> <?= getCurrencySymbol($selectedOffer["price"]["currency"]) . " " . $selectedOffer["price"]["total"] ?></p>
  </div>
  <?php endif; ?>

  <div class="text-center">
    <a href="payment.php?offerId=<?= urlencode($offerId) ?>" class="btn btn-success btn-lg">Proceed to Secure Payment</a>
  </div>

</div>
</body>
</html>
