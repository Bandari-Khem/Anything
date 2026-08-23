<?php
require_once '../Backend/php/db.php';

// Get the email, username, and profile picture from the request
$email = $_GET['email'];
$username = $_POST['username'];
$profilePic = $_FILES['profile-pic']['name'] ?? null;

// Get the password from the request
$password = $_POST['password'];

// Hash the password using password_hash()
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Handle file upload
$uploadDir = 'pp/'; // Folder where profile pictures will be saved
$uploadPath = $uploadDir . basename($profilePic);

// Check if file was uploaded
if ($profilePic && is_uploaded_file($_FILES['profile-pic']['tmp_name'])) {
    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], $uploadPath)) {
        // File uploaded successfully
        $profilePicPath = $uploadPath; // Store the file path
    } else {
        // File upload failed
        echo "Failed to upload profile picture.";
        header("Location: registration.html");
        exit;
    }
} else {
    // No file uploaded
    $profilePicPath = null;
}

// Insert the user into the database
$stmt = $conn->prepare("INSERT INTO users (email, username, password, profile_pic, is_verified) VALUES (?, ?, ?, ?, 1)");
$stmt->bind_param("ssss", $email, $username, $hashedPassword, $profilePicPath);

if ($stmt->execute()) {
    echo "Registration successful!";
    header("Location: login.html");
} else {
    echo "Registration failed.";
    header("Location: registration.html");
}

$stmt->close();
$conn->close();
?>