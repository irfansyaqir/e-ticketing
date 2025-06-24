# e-ticketing

E-Ticketing System (Laravel + Vue + MySQL)
Requirements

    PHP 8.2+

    Composer

    MySQL

    Node.js 18+

    npm

Backend Setup (Laravel)

    Clone or download the project

    Navigate to the backend folder

cd e-ticketing

    Install PHP dependencies

composer install

    Copy the example environment file

cp .env.example .env

    Configure your .env file with correct database credentials

DB_DATABASE=eventsystem
DB_USERNAME=root
DB_PASSWORD=

    Generate application key

php artisan key:generate

    Run database migrations

php artisan migrate

    Seed sample data (creates organizer, VIP user, regular user, and events)

php artisan db:seed --class=SampleDataSeeder

    Serve Laravel backend

php artisan serve

Backend API will be available at http://127.0.0.1:8000/api
Frontend Setup (Vue 3)

    Navigate to the frontend folder

cd e-ticketing-frontend

    Install dependencies

npm install

    Start development server

npm run dev

Frontend will be available at http://localhost:5173
CORS Setup

    In Laravel backend, open config/cors.php

    Allow Vue frontend origin

'allowed_origins' => ['http://localhost:5173'],
'paths' => ['api/*'],

    Clear Laravel config cache

php artisan config:cache

Test Accounts

You can use these accounts from the seeded data:

    Organizer: organizer@example.com / password

    VIP User: vip@example.com / password

    Regular User: user@example.com / password

Basic Flow

    Login using one of the test accounts

    Organizer can create new events

    All users can view events

    Only VIP users can book tickets during the first 24 hours after event creation

    After 24 hours, all users can book tickets if available

    Users can view their bookings and cancel bookings
