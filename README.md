# Laravel with DataTables pagination
Basic exemple project in Laravel 8 using DataTables and pagination with Server-Side Processing

## Installing dependencies
`composer install`

## Environmoent variables
Copy .env.example to .env and setup your environment variables

## Setup Database
This command will create the example table (users) and will also populate it with 1000 records for testing.

`php artisan migrate --seed`

## Routes
This project has only two routes:

"/" - View with DataTables

"/pagination" - Endpoint used by DataTables for get data;
