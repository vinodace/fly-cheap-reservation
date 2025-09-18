<?php
session_start();
require 'vendor/autoload.php'; // Make sure you installed guzzle: composer require guzzlehttp/guzzle

use GuzzleHttp\Client;

// 1. Get offer and passenger details from session
$offerId = $_POST['offerId'] ?? null;
$selectedOffer = $_SESSION['flights'][$offerId] ?? null;
$passengers    = $_SESSION['passengers'] ?? []; // store passengers in confirm-booking.php

if (!$selectedOffer || empty($passengers)) {
    die("❌ Missing booking data. Please restart your booking.");
}

// 2. Simulate payment validation
$cardHolder = $_POST['card_holder'] ?? '';
$cardNumber = $_POST['card_number'] ?? '';
$expiryMonth = $_POST['expiry_month'] ?? '';
$expiryYear  = $_POST['expiry_year'] ?? '';
$cvv         = $_POST['cvv'] ?? '';

// 🚨 In test mode we just simulate
$paymentSuccess = true; 

if (!$paymentSuccess) {
    die("❌ Payment failed. Please try again.");
}

// 3. Get Amadeus Access Token
$client = new Client();
$response = $client->post('https://test.api.amadeus.com/v1/security/oauth2/token', [
    'form_params' => [
        'grant_type'    => 'client_credentials',
        'client_id'     => 'IMewQoGGzsLuxu2vR2r9ImKFeRVNbf4m',
        'client_secret' => 'bLW0u8zhqigZYcaC'
    ]
]);
$token = json_decode($response->getBody(), true)['access_token'];

// 4. Call Amadeus Flight Orders API
$response = $client->post('https://test.api.amadeus.com/v1/booking/flight-orders', [
    'headers' => [
        'Authorization' => "Bearer $token",
        'Content-Type'  => 'application/json'
    ],
    'json' => [
        "type" => "flight-order",
        "flightOffers" => [$selectedOffer],
        "travelers"    => $passengers
    ]
]);

$order = json_decode($response->getBody(), true);

// 5. Generate confirmation number
$confirmationId = $order['data']['id'] ?? strtoupper(uniqid("CONF-"));

// Save booking to session
$_SESSION['order'] = $order;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Confirmation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#f9f9f9; }
    .confirm-box { background:#fff; padding:25px; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.1); margin-bottom:25px; }
    .success-msg { font-size:22px; font-weight:600; color:#28a745; }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="text-center mb-4">
    <div class="success-msg">✅ Payment Successful & Booking Confirmed!</div>
    <p class="text-muted">Your booking has been created with Amadeus.</p>
  </div>

  <div class="confirm-box">
    <h4>Confirmation ID: <?= htmlspecialchars($confirmationId) ?></h4>
    <p><strong>Total Paid:</strong> <?= htmlspecialchars($selectedOffer["price"]["currency"]) ?> <?= htmlspecialchars($selectedOffer["price"]["total"]) ?></p>
  </div>

  <div class="confirm-box">
    <h5>Passenger(s)</h5>
    <ul>
      <?php foreach ($passengers as $p): ?>
        <li><?= htmlspecialchars($p['name']['firstName'] . " " . $p['name']['lastName']) ?> (<?= $p['gender'] ?>)</li>
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
      <p><strong>Route:</strong> <?= $firstSeg["departure"]["iataCode"] ?> → <?= $lastSeg["arrival"]["iataCode"] ?></p>
      <p><strong>Time:</strong> <?= date("h:i A", strtotime($firstSeg["departure"]["at"])) ?> → <?= date("h:i A", strtotime($lastSeg["arrival"]["at"])) ?></p>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>
