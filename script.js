fetch('fetch_books.php')
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('bookContainer');
        const books = data;

        // Display books in pairs (two per row)
        for (let i = 0; i < books.length; i += 2) {
            const row = document.createElement('div');
            row.className = 'book-row';

            // Book 1
            if (i < books.length) {
                const book = books[i];
                const box = document.createElement('div');
                box.className = 'book-box';

                const title = document.createElement('h2');
                title.textContent = book.title;
                title.className = 'book-title';

                const author = document.createElement('p');
                author.textContent = book.author;
                author.className = 'book-author';

                const description = document.createElement('p');
                description.textContent = book.description;
                description.className = 'book-description';

                const category = document.createElement('p');
                category.textContent = book.category;
                category.className = 'book-category';

                box.appendChild(title);
                box.appendChild(author);
                box.appendChild(description);
                box.appendChild(category);

                row.appendChild(box);
            }

            // Book 2
            if (i + 1 < books.length) {
                const book = books[i + 1];
                const box = document.createElement('div');
                box.className = 'book-box';

                const title = document.createElement('h2');
                title.textContent = book.title;
                title.className = 'book-title';

                const author = document.createElement('p');
                author.textContent = book.author;
                author.className = 'book-author';

                const description = document.createElement('p');
                description.textContent = book.description;
                description.className = 'book-description';

                const category = document.createElement('p');
                category.textContent = book.category;
                category.className = 'book-category';

                box.appendChild(title);
                box.appendChild(author);
                box.appendChild(description);
                box.appendChild(category);

                row.appendChild(box);
            }

            container.appendChild(row);
        }
    })
    .catch(error => {
        console.error('Error fetching books:', error);
    });