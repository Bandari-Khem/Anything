<?php
// Include the database connection
require_once '../Backend/php/db.php';

// Fetch all books from the database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

$books = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Close the connection
$conn->close();

// Output the books in JSON format
header('Content-Type: application/json');
echo json_encode($books);
?>