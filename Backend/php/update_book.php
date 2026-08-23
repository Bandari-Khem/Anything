<?php
//  database connection
include 'db.php';

// Get form data
$id = intval($_POST['id']);
$title = $_POST['title'];
$author = $_POST['author'];
$category = $_POST['category'];
$filetype = $_POST['filetype'];
$description = $_POST['description'];
$file_path = $_POST['file_path'];

// Update the book in the database
$query = "UPDATE books SET 
          title = '$title', 
          author = '$author', 
          category = '$category', 
          type = '$filetype', 
          description = '$description', 
          file_path = '$file_path' 
          WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Book updated successfully!'); window.location.href = '../index.php';</script>";
} else {
    echo "<script>alert('Error updating book: " . mysqli_error($conn) . "');</script>";
}
?>