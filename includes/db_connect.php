<?php
/*$host     = "92.205.150.118";   // Database host (use "127.0.0.1" if localhost doesn’t work)
$username = "flycheap_user";        // Database username
$password = "#@!F!yche@p4312#@!";
$dbname   = "flycheapreservation_db";*/

// Database credentials
$host     = "localhost";   // Database host (use "127.0.0.1" if localhost doesn’t work)
$username = "root";        // Database username
$password = "";            // Database password (default empty in XAMPP)
$dbname   = "travelweb_db"; // Change to your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} 
// else {
//     echo "✅ Connected successfully!";
// }
?>
