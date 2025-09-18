<!DOCTYPE html>
<html lang="en">

<head>
  <title>Hotels</title>

<?php include("header.php"); ?>

  <!DOCTYPE html>
<html>
<head>
  <title>Hotel Search - Amadeus API</title>
</head>
<body>
  <h2>Search Hotels</h2>
  <form method="post" action="">
    <label>City Code (e.g. DEL, NYC, PAR):</label>
    <input type="text" name="cityCode" required><br><br>

    <label>Check-in Date:</label>
    <input type="date" name="checkInDate" required><br><br>

    <label>Check-out Date:</label>
    <input type="date" name="checkOutDate" required><br><br>

    <label>Adults:</label>
    <input type="number" name="adults" value="1" min="1" required><br><br>

    <input type="submit" name="search" value="Search Hotels">
  </form>

  <h3>Results</h3>
  <pre>
<?php
if (isset($_POST['search'])) {
    // Amadeus API credentials
    $client_id     = "IMewQoGGzsLuxu2vR2r9ImKFeRVNbf4m";
    $client_secret = "bLW0u8zhqigZYcaC";

    // Step 1: Get Access Token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://test.api.amadeus.com/v1/security/oauth2/token");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type'    => 'client_credentials',
        'client_id'     => $client_id,
        'client_secret' => $client_secret
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $auth = json_decode($response, true);

    if (!isset($auth['access_token'])) {
        die("Error: Could not authenticate with Amadeus API.\n" . $response);
    }
    $token = $auth['access_token'];

    // Step 2: Search Hotels
    $cityCode    = $_POST['cityCode'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate= $_POST['checkOutDate'];
    $adults      = $_POST['adults'];

    $url = "https://test.api.amadeus.com/v2/shopping/hotel-offers?cityCode=$cityCode&checkInDate=$checkInDate&checkOutDate=$checkOutDate&adults=$adults";


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    echo htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
}
?>
  </pre>


<?php include("footer.php"); ?>


 