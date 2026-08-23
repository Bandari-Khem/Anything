<?php
// reset-password-complete.php

// Database connection
require_once '../Backend/php/db.php';

// Get token and password from POST
$token = $_POST['token'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm-password'] ?? '';

// Validate passwords
if ($password !== $confirmPassword) {
    die("Passwords do not match.");
}

// Validate token and check expiration
$stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_token_expires > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Invalid or expired token.");
}

$user = $result->fetch_assoc();

// Update the user's password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$updateStmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expires = NULL WHERE email = ?");
$updateStmt->bind_param("ss", $hashedPassword, $user['email']);

if ($updateStmt->execute()) {
    echo "Your password has been successfully reset.";
    header("Location: login.html");
    exit();
} else {
    die("Error: " . $updateStmt->error);
}

$updateStmt->close();
$stmt->close();
$conn->close();
?>
<!-- How to Use Email Functionality (PHPMailer)
Install PHPMailer using Composer:

Run
composer require phpmailer/phpmailer
Place the vendor/autoload.php file in the same directory as your 
reset-password.php
.

Configure your SMTP settings in 
reset-password.php
 with your email service (e.g., Gmail, Outlook, etc.).

Test the email sending by visiting the 
reset-password.html
 page and checking your inbox. -->
