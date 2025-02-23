# Laravel Project Setup Guide

## Prerequisites
Before starting, make sure you have the following installed:

- [PHP](https://www.php.net/downloads.php) (>= 8.1 recommended)
- [Composer](https://getcomposer.org/download/)
- A database system (MySQL, PostgreSQL, SQLite, etc.)
- [Git](https://git-scm.com/downloads) (optional, but recommended)

## 1. Clone the Repository
To get the project, clone it from GitHub:

```sh
git clone https://github.com/AlphaTeam-UOB/Agile-Project.git
```

Then, move into the project directory:

```sh
cd Agile-Project
```

## 2. Set Up Laravel Environment
Create a new `.env` file by copying `.env.example`:

```sh
cp .env.example .env
```

Then generate the application key:

```sh
php artisan key:generate
```

## 3. Set Up Database
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

## 4. Run Laravel Development Server
Start the Laravel application with:

```sh
php artisan serve
```

The default local development URL is: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 5. Clearing Cache (if needed)
```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 6. Running Tests
```sh
php artisan test
```

## 7. Stopping the Development Server
Press `CTRL + C` in the terminal to stop the server.

## Conclusion
Now you have a fully set up Laravel project. 🎉

