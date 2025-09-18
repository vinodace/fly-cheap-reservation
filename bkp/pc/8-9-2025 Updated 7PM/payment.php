<?php
session_start();

$offerId = $_GET['offerId'] ?? null;
$selectedOffer = $_SESSION['flights'][$offerId] ?? null;

if (!$selectedOffer) {
    die("❌ Flight offer not found.");
}
?>

<?php

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
  <title>Secure Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style>
    body { background:#f9f9f9; }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <img src="images/logo.png" alt="" class="logo mb-4">
      <div class="payment-box mx-auto">
        <h2 class="mb-4 text-center">Secure Payment</h2>
        <p class="text-muted text-center">
          Booking for <strong><?= htmlspecialchars($selectedOffer["itineraries"][0]["segments"][0]["departure"]["iataCode"]) ?>
          → <?= htmlspecialchars($selectedOffer["itineraries"][0]["segments"][count($selectedOffer["itineraries"][0]["segments"])-1]["arrival"]["iataCode"]) ?></strong>
          | Amount: 
          <!-- <strong><?= htmlspecialchars($selectedOffer["price"]["currency"]) ?> <?= htmlspecialchars($selectedOffer["price"]["total"]) ?></strong> -->
          <strong><?= getCurrencySymbol($selectedOffer["price"]["currency"]) ?> <?= htmlspecialchars($selectedOffer["price"]["total"]) ?></strong>

        </p>

        <div class="payment-card-box">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <p class="wrap-prgh_web1 py-0">Debit/Credit Card</p>
            <img src="images/card-logo.png" alt="" class="payment-card-logo">
          </div>
          <form action="finalize-booking.php" method="post">
            <input type="hidden" name="offerId" value="<?= htmlspecialchars($offerId) ?>">
            <div class="row">
              <div class="col-sm-12">
                <div class="position-relative mb-3">
                  <label class="payment-lbl">Card Holder Name</label>
                  <input type="text" name="card_holder" class="payment-field alphabet"  required>
                  <div class="errmsg"></div>
                </div>

                <div class="position-relative mb-3">
                  <label class="payment-lbl">Card Number</label>
                  <input type="text" name="card_number" maxlength="14" class="payment-field number" inputmode="numeric" maxlength="16" required>
                  <div class="errmsg"></div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <div class="position-relative">
                      <label class="payment-lbl">Expiry Month</label>
                      <!-- <input type="text" name="expiry_month" maxlength="2" class="form-control" maxlength="2" required> -->
                      <select name="expiry_month" class="payment-field">
                        <option value="0">Month</option>
                        <option value="01">Jan</option>
                        <option value="02">Feb</option>
                        <option value="03">Mar</option>
                        <option value="04">Apr</option>
                        <option value="05">May</option>
                        <option value="06">Jun</option>
                        <option value="07">Jul</option>
                        <option value="08">Aug</option>
                        <option value="09">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                      </select>
                    </div>  
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="position-relative">
                      <label class="payment-lbl">Expiry Year</label>
                      <!-- <input type="text" name="expiry_year" maxlength="4" class="payment-field" maxlength="4" required> -->
                      <select name="expiry_year" class="payment-field">
                        <option value="0">Year</option>
                        <?php for ($i=2025; $i <=2045; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor ?>
                      </select>
                    </div>  
                  </div>
                </div>    
              </div>
              <div class="col-md-3">
                <div class="position-relative mb-3">
                  <label class="payment-lbl">CVV</label>
                  <input type="password" name="cvv" maxlength="3" class="payment-field number" inputmode="numeric" maxlength="4" required>
                </div>
                <div class="errmsg"></div>
              </div>
            </div>  
            <div class="text-end">
              <button type="submit" class="wrap-btn_web1 bg-success border-success">Pay & Confirm Booking</button>
            </div>
          </form>
        </div>

        
      </div>
    </div>
  </div>    
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  $(function(){
     // Numbers only
     $(".number").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
           $(this).next(".errmsg")
              .html("Numbers only")
              .stop()
              .show()
              .fadeOut("slow");
           return false;
        }
     });

     // Alphabets only
     $(".alphabet").keypress(function (e) {
        // A-Z (65–90), a-z (97–122), backspace(8), space(32)
        if (e.which != 8 && e.which != 32 && (e.which < 65 || (e.which > 90 && e.which < 97) || e.which > 122)) {
           $(this).next(".errmsg")
              .html("Alphabets only")
              .stop()
              .show()
              .fadeOut("slow");
           return false;
        }
     });
  });
</script>
</body>
</html>
