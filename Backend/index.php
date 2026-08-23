<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLibrary - Upload, View, Edit, Delete Books</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>eLibrary</h1>
        <p>Upload, View, Edit, and Delete Books</p>
    </header>

    <main>
        <section>
            <h2>Upload a Book</h2>
            <form action="php/upload_book.php" method="post" enctype="multipart/form-data">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required><br><br>

                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required><br><br>
               
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="Academic">Academic</option>
                    <option value="Non-Academic">Non-Academic</option>
                </select><br><br>

                <input type="file" name="file" accept=".pdf,.epub,.txt,.docx" required><br><br>
                  
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea><br><br>

                <input type="submit" value="Upload Book">
            </form>
        </section>

        <section>
            <h2>Uploaded Books</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>File Type</th>
                    <th>Description</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>

                <?php include 'php/display_books.php'?>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 eLibrary. All rights reserved.</p>
    </footer>
</body>

</html>