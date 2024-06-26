# Laravel Project Setup Guide

This guide provides detailed steps for setting up a Laravel project, including installation, database migration, and seeding.

## Prerequisites

Before you begin, ensure you have met the following requirements:
- Composer installed on your machine
- PHP >= 8.1
- Node.js and npm installed
- MySQL or any other supported database

## Installation

1. **Clone the repository**

    ```sh
    git clone <repository-url>
    cd <repository-directory>
    ```

2. **Install Composer dependencies**

    ```sh
    composer install
    ```

3. **Install npm dependencies**

    ```sh
    npm install
    ```

4. **Create a copy of the `.env` file**

    ```sh
    cp .env.example .env
    ```

5. **Configure your environment variables**

    Open the `.env` file and update the necessary environment variables, particularly the database configuration.

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

## Database Migration and Seeding

1. **Run the database migrations**

    ```sh
    php artisan migrate
    ```

    This command will create the necessary tables in your database.

2. **Run the database seeders**

    ```sh
    php artisan db:seed
    ```

    This command will populate the database with initial data defined in the seeders.

## Additional Commands

- **Running the development server**

    ```sh
    php artisan serve
    ```

    This command will start a local development server at `http://127.0.0.1:8000`.

- **Compiling assets**

    For development:

    ```sh
    npm run dev
    ```

    For production:

    ```sh
    npm run production
    ```
