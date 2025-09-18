<?php
session_start();
include 'includes/db_connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['login-email'] ?? '');
    $password = $_POST['login-password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, first_name, last_name, user_email, user_password FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['user_password'])) {
                // Set session
                $_SESSION['user_id']    = $row['id'];
                $_SESSION['user_name']  = $row['first_name'] . ' ' . $row['last_name'];
                $_SESSION['user_email'] = $row['user_email'];

                // ✅ Tell JS to redirect, no message
                echo json_encode([
                    "status" => "success",
                    //"message" => "✅ Successfully Login"
                    "redirect" => "my-account/"
                    //"redirect" => "my-account.php"
                ]);
                exit;
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "❌ Invalid password."
                ]);
                exit;
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "❌ No account found with this email."
            ]);
            exit;
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Please enter both email and password."
        ]);
        exit;
    }
}
?>
