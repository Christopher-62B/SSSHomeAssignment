# Library Management System (LibrarySys)

# Project Description

This project is a Library Management System developed using Laravel version 10. It allows a librarian or administrator to 
manage books, borrowers and book loans

# Database Structure
The system consists of five main tables:

- Author
- Category
- Book
- Borrower
- Loan

Books belong to one Author and one category but one Author can have many Books as well as a Category.
Borrowers can have multiple loans and each loan refers to one book and one borrower

# Features

- Book management with full CRUD functionality (adding a Book, Deleting a Book, Editing a Book and reading Book details)
- Borrower creation
- Loan creation and book return tracking
- Filtering and sorting of books
- SEO-friendly URLs using slugs

# Technologies used

- Laravel version 10
- PHP
- MariaDB
- Blade
- Eloquent ORM
- Bootstrap

# How to Run

1. Run migrations and seeders:
    php artisan migrate:fresh --seed

2. Start the server:
    php artisan serve --host=0.0.0.0 --port=8000

3. Open the application in a browser