<?php
include 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM books WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<script>alert('Book not found'); window.location.href = '../index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main>
        <h2>Edit Book</h2>
        <form action="update_book.php" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <label>Title:</label>
            <input type="text" name="title" value="<?= $row['title'] ?>"><br><br>
            <label>Author:</label>
            <input type="text" name="author" value="<?= $row['author'] ?>"><br><br>
            <label>Category:</label>
            <select name="category">
                <option value="Academic" <?= $row['category'] === 'Academic' ? 'selected' : '' ?>>Academic</option>
                <option value="Non-Academic" <?= $row['category'] === 'Non-Academic' ? 'selected' : '' ?>>Non-Academic</option>
            </select><br><br>
            <label>File Type:</label>
            <input type="text" name="filetype" value="<?= $row['type'] ?>"><br><br>
            <label>Description:</label>
            <textarea name="description"><?= $row['description'] ?></textarea><br><br>
            <label>File Path:</label>
            <input type="text" name="file_path" value="<?= $row['file_path'] ?>"><br><br>
            <input type="submit" value="Update Book">
        </form>
    </main>
</body>
</html>