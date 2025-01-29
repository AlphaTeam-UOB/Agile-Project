# Laravel Project Setup Guide

## Prerequisites
Before starting, make sure you have the following installed:

- [PHP](https://www.php.net/downloads.php) (>= 8.1 recommended)
- [Composer](https://getcomposer.org/download/)
- [Node.js & NPM](https://nodejs.org/)
- A database system (MySQL, PostgreSQL, SQLite, etc.)
- [Git](https://git-scm.com/downloads) (optional, but recommended)

## 1. Create a New Laravel Project
To create a new Laravel project, run:

```sh
composer create-project --prefer-dist laravel/laravel AgileProject
```
(*Replace `AgileProject` with your desired project name. Avoid spaces in the name!*)

Or, if you have the Laravel installer globally installed:

```sh
laravel new AgileProject
```

## 2. Move Into the Project Directory
```sh
cd AgileProject
```

## 3. Set Up Laravel Environment
```sh
cp .env.example .env
php artisan key:generate
```

## 4. Set Up Database
Edit the `.env` file and update your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Then run migrations:

```sh
php artisan migrate
```

## 5. Install Laravel Breeze (Authentication System)
Breeze provides simple authentication scaffolding. Install it using:

```sh
composer require laravel/breeze --dev
```

Then install the authentication UI:

For simple Blade authentication:
```sh
php artisan breeze:install
```

For React-based authentication:
```sh
php artisan breeze:install react
```

For Vue-based authentication:
```sh
php artisan breeze:install vue
```

## 6. Install Frontend Dependencies
Run the following commands to install JavaScript dependencies and compile assets:

```sh
npm install
npm run dev
```

## 7. Run Laravel Development Server
Start the Laravel application with:

```sh
php artisan serve
```

The default local development URL is: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 8. Running the Project with a Database
Ensure your database is running, and then run:

```sh
php artisan migrate
```

If you need to reset the database:
```sh
php artisan migrate:fresh --seed
```

## 9. Additional Laravel Commands
### Clearing Cache
```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Running Tests
```sh
php artisan test
```

### Creating Models, Controllers, and Migrations
#### Create a Model with Migration and Controller
```sh
php artisan make:model Post -mc
```
(This creates a `Post` model, a migration file, and a controller.)

#### Running Migrations
```sh
php artisan migrate
```

## 10. Stopping the Development Server
Press `CTRL + C` in the terminal to stop the server.

## Conclusion
Now you have a fully set up Laravel project with authentication using Breeze. 🎉
