<?php
// echo"<script>window.open("../../index.html")</script>";
$host = 'localhost';
$db = 'elibrary';
$user = 'libiee';
$pass = 'hamroramroLibrary';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
