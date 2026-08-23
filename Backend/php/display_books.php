<?php
include 'db.php';

$query = "SELECT * FROM books";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['author'] . "</td>";
    echo "<td>" . $row['category'] . "</td>";
    echo "<td>" . $row['type'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td><a href='php/" . $row['file_path'] . "' target='_blank'>View</a></td>";
    echo "<td>
            <a href='php/edit_book.php?id=" . $row['id'] . "'>Edit</a> |
            <a href='php/delete_book.php?id=" . $row['id'] . "'>Delete</a>
          </td>";
    echo "</tr>";
}
?>