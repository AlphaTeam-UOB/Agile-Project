# Laravel Project Setup Guide

## Prerequisites
Before starting, make sure you have the following installed:

- [PHP](https://www.php.net/downloads.php) (>= 8.1 recommended)
- [Composer](https://getcomposer.org/download/)
- A database system (MySQL, PostgreSQL, SQLite, etc.)
- [Git](https://git-scm.com/downloads) (optional, but recommended)
- [XAMPP](https://www.apachefriends.org/) or any alternative server
Ngrok (for exposing your local server to the internet)
## 1. Start MySQL and Apache
If you're using **XAMPP**, open the control panel and start **Apache** and **MySQL**.
If you're using another local server, ensure your web server and database are running.

## 2. Clone the Repository
1. Open **VS Code**.
2. Click on **File > Open Folder** and select a directory where you want to store the project.
3. Open the **terminal** in VS Code (**View > Terminal** or `Ctrl + ~`).
4. Run the following command to clone the repository:

```sh
git clone https://github.com/AlphaTeam-UOB/Agile-Project.git
```

Then, move into the project directory:

```sh
cd Agile-Project
```

## 3. Set Up Laravel Environment
Create a new `.env` file by copying `.env.example`:

```sh
cp .env.example .env
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

## 5. Manually Adding an Admin User
You can manually create an admin user using Laravel Tinker:

1. Open a terminal and run:
   ```sh
   php artisan tinker
   ```

2. In the Tinker interactive shell, execute the following command:
   ```php
   use App\Models\User;

   User::create([
       'name' => 'test',
       'email' => 'test@test.com',
       'password' => bcrypt('12345678'),
   ]);
   ```

3. Exit Tinker by typing:
   ```sh
   exit
   ```

4. Your admin user is now created and can log in with:
   - **Email:** `admin@example.com`
   - **Password:** `your_secure_password`

## 6. Run Laravel Development Server
Start the Laravel application with:

```sh
php artisan serve
```

The default local development URL is: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 7. Clearing Cache (if needed)
```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 8. Running Tests
```sh
php artisan test
```

## 9. Stopping the Development Server
Press `CTRL + C` in the terminal to stop the server.

## Conclusion
Now you have a fully set up Laravel project with an admin user. 🎉

7. Set Up Ngrok for Public Access
To expose your local Laravel server to the internet (required for Dialogflow integration):

Download and Install Ngrok:

Go to ngrok.com and download the appropriate version for your operating system.

Extract the .zip file to a directory (e.g., C:\ngrok).

Add Ngrok to System PATH:

Add the directory where you extracted Ngrok to your system's PATH (see Ngrok installation instructions).

Authenticate Ngrok:

Sign up for a free Ngrok account at https://dashboard.ngrok.com/signup.

Copy your authtoken from the Ngrok dashboard: https://dashboard.ngrok.com/get-started/your-authtoken.

Run the following command to authenticate Ngrok:

bash
Copy
ngrok authtoken YOUR_AUTHTOKEN
Expose Your Laravel Server:

In a new terminal, run the following command:

bash
Copy
ngrok http 8000
Ngrok will generate a public URL (e.g., https://abcd1234.ngrok.io).

Update Dialogflow Webhook URL:

Go to your Dialogflow agent's Fulfillment settings.

Replace the webhook URL with the Ngrok URL (e.g., https://abcd1234.ngrok.io/chatbot).