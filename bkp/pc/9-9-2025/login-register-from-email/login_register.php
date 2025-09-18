<?php
session_start();
include 'includes/db_connect.php'; // your DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if user already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // User exists → login
            $_SESSION['user_email'] = $email;
            $message = "<div class='signup-account-msg'>✅ Welcome back!</div>";
        } else {
            // User doesn't exist → register
            $stmt_insert = $conn->prepare("INSERT INTO users (user_email) VALUES (?)");
            $stmt_insert->bind_param("s", $email);
            $stmt_insert->execute();

            $_SESSION['user_email'] = $email;
            $message = "<div class='signup-account-msg'>✅ Email registered successfully!</div>";
        }

        $stmt->close();

        // Redirect or show message
        header("Location: index.php?msg=" . urlencode($message));
        exit;

    } else {
        header("Location: index.php?msg=" . urlencode("⚠️ Invalid email address."));
        exit;
    }
}
