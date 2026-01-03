# This is a basic breakdown of my project currently.

## Project Description and Database Structure:

My project is a Library Management System, where a library administrator/Librarian can manage the library's
stock and also manage book loans and their borrowers.

It is spit into 5 tables

1. Author
2. Category
3. Book
4. Borrower
5. Loan



-- Author contains the following table fields:

1. id
2. name
3. bio (aka Biography as flavour text (optional))
4. timestamps (the default Laravel field that shows the time when the record was created/updated)



-- Category table fields:

1. id
2. name
3. description (optional)
4. timestamps (the default Laravel field that shows the time when the record was created/updated)



-- Book table fields:

1. id
2. title
3. slug (so that it looks cleaner in the URL)
4. isbn (added for extra realism to the project)
5. published_year (date of publish)
6. available ((added later) for the loan table to see if borrowers were eligible to borrow the book)
7. timestamps (the default Laravel field that shows the time when the record was created/updated)

~ Foreign Keys:

1. author_id (References the Author table)
2. category_id (References the Category table)



-- Borrower table fields:

1. id
2. name
3. email
4. phone (mobile number)
5. timestamps (the default Laravel field that shows the time when the record was created/updated)



-- Loan table fields:

1. id
2. borrowed_at (The date when the book was borrowed)
3. due_date (date when the book should be returned)
4. returned_at (optional because borrowers might not return the book)
5. timestamps (the default Laravel field that shows the time when the record was created/updated)

~ Foreign Keys:

1. book_id (References Book table)
2. borrower_id (References Borrower table)


## Database Relationships

These were done using the Eloquent ORM

-- Author:

One to Many relationship with Book table: 

Because one Author can have many Books and a Book belongs to one Author

-- Category:

One to Many relatioship with Book table:

One Category can have many Books, but a Book has one Category

-- Book:

One to Many realtionship with Loan table:

One Book could have had many loans but a Loan can only refer to one Book

(Meaning that a Book could have multiple Loans listed under it but a Loan can only have one of the same Book)

-- Borrower:

One to Many relationship with Loan table:

One Borrower can have multiple Loans but a Loan can only refer to one Borrower.

(Meaning that a Borrower can have multiple loans under their name but a Loan can only be linked to one Borrower).

## Features

The features I used in the project were to Adhere to the CRUD principle:

C - Create, Feature for Creation = Loan creation (Borrowing a Book)

R - Read, Feature for Reading = Information on Books and loans can be seen on screen

U - Update, Feature for Updating = Loan information can be updated from the loans table

D - Deletion, Feature for Deletion = Will be added in the future as it is not implemented yet.

## Technologies used

Laravel (version 10)
PHP
MariaDB 
Blade (for user interface)
Eloquent ORM (for database interation)
HTML

## How I ran the project

1. Command used: php artisan serve --host=0.0.0.0 --port=8000
2. Then I opened Google Chrome. Did not try my project on MS Edge.
