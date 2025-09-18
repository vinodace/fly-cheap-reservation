<?php
session_start();
include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname   = mysqli_real_escape_string($conn, $_POST['first-name'] ?? '');
    $lname   = mysqli_real_escape_string($conn, $_POST['last-name'] ?? '');
    $email   = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');

    if(empty($fname) || empty($lname) || empty($email) || empty($password)) {
        echo "<div class='login_singup_errmsg'>⚠️ Please fill all required fields.</div>";
        exit();
    }

    $check = $conn->prepare("SELECT id FROM users WHERE user_email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<div class='login_singup_errmsg text-warning'>⚠️ Email already registered.</div>";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, user_email, user_password, user_phone, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $fname, $lname, $email, $password, $phone);

    if ($stmt->execute()) {
        echo "<div class='login_singup_errmsg text-success'>✅ Account created successfully. Please login.</div>";
    } else {
        echo "<div class='login_singup_errmsg'>❌ Error: ".$stmt->error."</div>";
    }

    $stmt->close();
    $check->close();
}
?>
