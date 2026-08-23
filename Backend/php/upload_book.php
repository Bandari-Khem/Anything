<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $file = $_FILES['file'];
    $description = $_POST['description'];
    // Extracting file extension

    $hamro_file_name = $_FILES['file']['name'];
    $filetype = pathinfo($hamro_file_name, PATHINFO_EXTENSION);

    $allowed_extensions = ['pdf', 'txt', 'epub', 'docx'];
    $file_extension = strtolower(pathinfo($hamro_file_name, PATHINFO_EXTENSION));

    if (!in_array($file_extension, $allowed_extensions)) {
        echo "<script>alert('Invalid file type: " . $hamro_file_name . ". Only PDF, TXT, EPUB, and DOCX files are allowed.'); window.location.href = '../index.php';</script>";
        exit; // Stop the script if file type is invalid
    }

    if ($file['error'] === UPLOAD_ERR_OK) {
        $file_name = basename($file['name']);
        $file_path = 'uploads/' . $file_name;

        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            $query = "INSERT INTO books (title, author, category, file_path, type, description) 
                      VALUES ('$title', '$author', '$category', '$file_path', '$filetype', '$description')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Book uploaded successfully!'); window.location.href = '../index.php';</script>";
            } else {
                echo "<script>alert('Error uploading book: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Error moving uploaded file');</script>";
        }
    } else {
        echo "<script>alert('Error uploading file');</script>";
    }
}
?>