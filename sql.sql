        /* --- MySQL database --- */

CREATE DATABASE IF NOT EXISTS elibrary
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE elibrary;
/* --- 
users
 --- */

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,

    role ENUM('admin', 'librarian', 'user')
        NOT NULL DEFAULT 'user',

    status TINYINT NOT NULL DEFAULT 1,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;


        /* --- 2. categories — the hierarchy table
    This is the most important table for our current task. --- */

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(150) NOT NULL,

    parent_id INT NULL,

    description TEXT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_category_parent
        FOREIGN KEY (parent_id)
        REFERENCES categories(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    INDEX idx_category_parent (parent_id)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;


/*How it works
Root category:
Academic
id = 1
parent_id = NULL
Child:
BCA
id = 2
parent_id = 1
Child of BCA:
4
id = 3
parent_id = 2
So:
Academic
   │
   └── BCA
         │
         └── 4
The database itself doesn't need to know that this is:
academic/bca/4/
PHP can calculate that.*/

    /* --- 3. books --- */
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,

    title VARCHAR(255) NOT NULL,

    category_id INT NOT NULL,

    description TEXT NULL,

    publisher VARCHAR(150) NULL,

    publication_year YEAR NULL,

    isbn VARCHAR(50) NULL,

    added_by INT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_book_category
        FOREIGN KEY (category_id)
        REFERENCES categories(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_book_user
        FOREIGN KEY (added_by)
        REFERENCES users(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    INDEX idx_book_category (category_id),
    INDEX idx_book_added_by (added_by)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;

        /* --- 4. book_files 
    One book can have one or more physical files.
    For example:
    Introduction to DBMS
            ├── Introduction.pdf
            ├── Introduction.epub
            └── Introduction.mobi --- */

CREATE TABLE book_files (
    id INT AUTO_INCREMENT PRIMARY KEY,

    book_id INT NOT NULL,

    file_name VARCHAR(255) NOT NULL,

    file_path VARCHAR(500) NOT NULL,

    file_type ENUM('pdf', 'epub', 'mobi', 'other')
        DEFAULT 'pdf',

    file_size BIGINT NULL,

    is_main TINYINT NOT NULL DEFAULT 1,

    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_file_book
        FOREIGN KEY (book_id)
        REFERENCES books(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    INDEX idx_file_book (book_id)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;

    /* --- 5. authors --- */

CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(150) NOT NULL,

    bio TEXT NULL
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;
/* ---
            6. book_authors
    This handles the many-to-many relationship.
 --- */

CREATE TABLE book_authors (
    id INT AUTO_INCREMENT PRIMARY KEY,

    book_id INT NOT NULL,

    author_id INT NOT NULL,

    UNIQUE (book_id, author_id),

    CONSTRAINT fk_book_author_book
        FOREIGN KEY (book_id)
        REFERENCES books(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_book_author_author
        FOREIGN KEY (author_id)
        REFERENCES authors(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    INDEX idx_book_author_book (book_id),
    INDEX idx_book_author_author (author_id)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;

        /* --- 7. activity_logs --- */

CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,

    action VARCHAR(255) NOT NULL,

    details TEXT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_activity_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    INDEX idx_activity_user (user_id),
    INDEX idx_activity_created (created_at)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;


/*
So our initial database is:
elibrary
│
├── users
│
├── categories
│      └── parent_id → categories.id
│
├── books
│      ├── category_id → categories.id
│      └── added_by → users.id
│
├── book_files
│      └── book_id → books.id
│
├── authors
│
├── book_authors
│      ├── book_id → books.id
│      └── author_id → authors.id
│
└── activity_logs
       └── user_id → users.id
       */