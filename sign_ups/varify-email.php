<?php
require_once '../Backend/php/db.php';

// Get the email from the URL
$email = isset($_GET['email']) ? $_GET['email'] : '';

// If no email is provided, redirect to registration
if (empty($email)) {
    header("Location: registration.html");
    exit();
}

// Check if the email exists
$result = $conn->query("SELECT * FROM users WHERE email = '$email'");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['is_verified'] == 0) {
        // Generate a confirmation link   // need to lean vercel or anything because this is domain system..
        $confirmationLink = "https://khembhandari.com/registration-step-3.html?email=" . urlencode($email);

        // Send the email
        mail($email, "Verify Your eLibrary Account", "Please click the link below to verify your email: " . $confirmationLink);

        // Redirect to the next step
        header("Location: registration-step-3.html");
        exit();
    } else {
        // Already verified, redirect to login
        header("Location: login.html");
        exit();
    }
} else {
    // Email not found, redirect to registration
    header("Location: registration.html");
    exit();
}
?>