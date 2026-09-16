# LUMÉ

LUMÉ is a web application developed with Laravel for a skincare store. The application allows users to manage products, categories, users, reviews, and other elements related to the store.

## Requirements

- PHP
- Composer
- MySQL
- Laravel
- Git

## Installation

Clone the repository:

git clone <REPOSITORY_URL>

Go to the project folder:

cd <PROJECT_NAME>

Install the dependencies:

composer install

Create the `.env` file from `.env.example` and configure the database connection:

DB_DATABASE=database_name
DB_USERNAME=username
DB_PASSWORD=password

Generate the application key:

php artisan key:generate

Create the database in MySQL and run the migrations:

php artisan migrate

To load the initial project data:

php artisan db:seed

## Running the Application

Start the local development server:

php artisan serve

The application will be available at:

http://127.0.0.1:8000

## Main Route

The main route of the application is `/`.

After starting the server, access:

http://127.0.0.1:8000/

From this page, the different sections of the application can be accessed.

## Project Structure

- `app/`: contains the controllers, models, services, and other application classes.
- `database/`: contains migrations, seeders, and factories.
- `resources/views/`: contains the Blade views.
- `routes/`: contains the application routes.
- `public/`: contains public files and images.
- `config/`: contains the application configuration files.

## Notes

The `.env` file contains environment-specific configuration and should not be uploaded to the repository.

To stop the local server, press `Ctrl + C`.
