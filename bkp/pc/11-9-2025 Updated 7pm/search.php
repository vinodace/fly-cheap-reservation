<?php
// Duffel Test Token - DO NOT expose in frontend code
$duffel_token = 'duffel_test_ZUyY7QPG1GC7Qyoh6Pxnl-PBIPEFppmqkEycZV5caqX';

// Get form data safely
$origin = strtoupper(trim($_POST['origin'] ?? ''));
$destination = strtoupper(trim($_POST['destination'] ?? ''));
$departure_date = $_POST['departure_date'] ?? '';
$return_date = $_POST['return_date'] ?? '';
$adults = max(1, intval($_POST['adults'] ?? 1));
$cabin_class = $_POST['cabin_class'] ?? 'economy';

// Prepare passengers array
$passengers = [];
for ($i = 0; $i < $adults; $i++) {
    $passengers[] = ['type' => 'adult'];
}

// Duffel offer request payload
$data = [
    'data' => [
        'slices' => [
            [
                'origin' => $origin,
                'destination' => $destination,
                'departure_date' => $departure_date
            ],
            [
                'origin' => $destination,
                'destination' => $origin,
                'departure_date' => $return_date
            ]
        ],
        'passengers' => $passengers,
        'cabin_class' => $cabin_class
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.duffel.com/air/offer_requests');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $duffel_token,
    'Content-Type: application/json',
    'Duffel-Version: v2'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// Display result
echo "<h2>Flight Search Result</h2>";
if ($error) {
    echo "<p style='color:red;'>Error: $error</p>";
} else {
    echo "<p>HTTP Status: $http_status</p>";
    echo "<pre>" . htmlspecialchars($response) . "</pre>";
}
?>


<?php
$data = json_decode($response, true);
$offers = $data['data'] ?? [];

echo "<h2>Flight Offers</h2>";

if (empty($offers)) {
    echo "<p>No offers found.</p>";
} else {
    foreach ($offers as $offer) {
        $total_amount = $offer['total_amount'] . ' ' . $offer['total_currency'];
        $owner = $offer['owner']['name'];
        $segments = $offer['slices'][0]['segments'];
        $origin = $segments[0]['origin']['iata_code'];
        $destination = $segments[0]['destination']['iata_code'];
        $departure_time = $segments[0]['departing_at'];

        echo "<div style='margin-bottom:20px; border:1px solid #ccc; padding:10px;'>";
        echo "<strong>Airline:</strong> $owner<br>";
        echo "<strong>Route:</strong> $origin → $destination<br>";
        echo "<strong>Departure:</strong> $departure_time<br>";
        echo "<strong>Total Price:</strong> $total_amount<br>";
        echo "</div>";
    }
}
 ?>