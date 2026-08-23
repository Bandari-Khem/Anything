<?php
// reset-password.php

// Database connection
require_once '../Backend/php/db.php';

// Get email from POST
$email = $_POST['email'] ?? '';

// Validate email format
$emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/';

if (empty($email) || !preg_match($emailRegex, $email)) {
    die("Invalid email address.");
}

// Check if the email exists in the database
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found with this email.");
}

// Fetch user data
$user = $result->fetch_assoc();

// Generate a unique token for password reset
$token = bin2hex(random_bytes(50)); // 50 bytes = 100 hex characters

// Set expiration time (e.g., 2 minutes from now)
$expires = date('Y-m-d H:i:s', strtotime('+2 minutes'));

// Update the user record with the token and expiration
$updateStmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expires = ? WHERE email = ?");
$updateStmt->bind_param("sss", $token, $expires, $email);

if ($updateStmt->execute()) {
    // Send the reset link via email using PHPMailer
    require 'vendor/autoload.php'; // Make sure this is in your project root
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; // Replace with your email
        $mail->Password = 'your_email_password'; // Replace with your password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your_email@example.com', 'eLibrary');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body = '
            <p>Hello,</p>
            <p>A password reset request has been made for your eLibrary account.</p>
            <p>Please click the link below to reset your password:</p>
            <a href="https://yourdomain.com/reset-password-confirm.php?token=' . $token . '">Reset Password</a>
            <p>If you did not request this, please ignore this email.</p>
        ';

        $mail->send();
        echo "A password reset link has been sent to your email. Please check your inbox.";
    } catch (Exception $e) {
        die("Error sending email: " . $e->getMessage());
    }

    // Redirect to login page after a short delay
    header("Location: reset-password.html");
    exit();
} else {
    die("Error: " . $updateStmt->error);
}

$updateStmt->close();
$stmt->close();
$conn->close();
?>