<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the file path from the database
    $query = "SELECT file_path FROM books WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $file_path = $row['file_path'];

    // Delete the file from the uploads directory
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Delete the book from the database
    $delete_query = "DELETE FROM books WHERE id = $id";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Book and file deleted successfully!'); window.location.href = '../index.php';</script>";
    } else {
        echo "<script>alert('Error deleting book: " . mysqli_error($conn) . "');</script>";
    }
}
?>