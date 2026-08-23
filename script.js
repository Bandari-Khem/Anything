fetch('fetch_books.php')
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('bookContainer');

        for (let i = 0; i < data.length; i += 2) {
            const row = document.createElement('div');
            row.className = 'book-row';

            // Book 1
            if (i < data.length) {
                const book = data[i];
                const box = createBookBox(book);
                row.appendChild(box);
            }

            // Book 2
            if (i + 1 < data.length) {
                const book = data[i + 1];
                const box = createBookBox(book);
                row.appendChild(box);
            }

            container.appendChild(row);
        }
    })
    .catch(error => {
        console.error('Error fetching books:', error);
    });

// Reusable function to create a book box
function createBookBox(book) {
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

    const readBtn = document.createElement('button');
    readBtn.textContent = 'Read';
    readBtn.className = 'book-btn read-btn';
    readBtn.onclick = () => {
        const originalHTML = box.innerHTML;

        const iframe = document.createElement('iframe');
        iframe.src = book.file_path;
        iframe.style.width = '100%';
        iframe.style.height = '600px';
        iframe.style.border = 'none';
        iframe.style.marginTop = '20px';

        const closeBtn = document.createElement('button');
        closeBtn.textContent = 'Close';
        closeBtn.className = 'book-btn close-btn';
        closeBtn.style.position = 'absolute';
        closeBtn.style.top = '10px';
        closeBtn.style.right = '10px';
        closeBtn.style.zIndex = '1000';
        closeBtn.onclick = () => {
            box.innerHTML = originalHTML;
        };

        box.innerHTML = '';
        box.appendChild(closeBtn);
        box.appendChild(iframe);
    };

    const downloadBtn = document.createElement('button');
    downloadBtn.textContent = 'Download';
    downloadBtn.className = 'book-btn download-btn';
    downloadBtn.onclick = () => {
        if (!isLoggedIn()) {
            alert('You need to be logged in to download.');
        } else {
            window.location.href = book.download_url;
        }
    };

    box.appendChild(title);
    box.appendChild(author);
    box.appendChild(description);
    box.appendChild(category);
    box.appendChild(readBtn);
    box.appendChild(downloadBtn);

    return box;
}

// Check if user is logged in
function isLoggedIn() {
    return document.cookie.includes('user_id=');
}