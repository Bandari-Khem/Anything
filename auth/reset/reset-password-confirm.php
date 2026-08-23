<?php
// reset-password-confirm.php

// Database connection
require_once '../Backend/php/db.php';

// Get token from URL
$token = $_GET['token'] ?? '';

// Validate token and check expiration
$stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_token_expires > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Invalid or expired token.");
}

$user = $result->fetch_assoc();

// If token is valid, show the password reset form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLibrary - Reset Password</title>
    <link rel="stylesheet" href="forms.css">
</head>
<body>
    <main>
        <section>
            <h2>Reset Password</h2>
            <form action="reset-password-complete.php" method="POST">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" required>
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                <button type="submit">Reset Password</button>
            </form>
        </section>
    </main>
</body>
</html>