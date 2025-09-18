<?php
// Make sure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../includes/db_connect.php'; 

// If not logged in → redirect to root login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../"); 
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details from DB
$stmt = $conn->prepare("SELECT first_name, last_name, user_email, user_phone, gender, address_1, address_2, country, state, city, zipcode, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// ✅ Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $address1 = mysqli_real_escape_string($conn, $_POST['address_1'] ?? '');
    $address2 = mysqli_real_escape_string($conn, $_POST['address_2'] ?? '');
    $country  = mysqli_real_escape_string($conn, $_POST['country'] ?? '');
    $state    = mysqli_real_escape_string($conn, $_POST['state'] ?? '');
    $city     = mysqli_real_escape_string($conn, $_POST['city'] ?? '');
    $zipcode  = mysqli_real_escape_string($conn, $_POST['zipcode'] ?? '');

    $sql = "UPDATE users SET 
                address_1=?, 
                address_2=?, 
                country=?, 
                state=?, 
                city=?, 
                zipcode=? 
            WHERE id=?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("ssssssi", $address1, $address2, $country, $state, $city, $zipcode, $user_id);

    if ($stmt2->execute()) {
        $msg = "<div class='login_singup_errmsg text-success'>✅ Address updated successfully.</div>";
        // Refresh user data so the new values show immediately
        $stmt = $conn->prepare("SELECT first_name, last_name, user_email, user_phone, gender, address_1, address_2, country, state, city, zipcode, created_at FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
    } else {
        $msg = "<div class='login_singup_errmsg text-danger'>❌ Error: ".$stmt2->error."</div>";
    }
    $stmt2->close();
}


?>
