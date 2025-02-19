<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Customer Side Routes
Route::get('/about', function () {
    return view('CustomerSide.AboutUs');
});

Route::get('/contact', function () {
    return view('CustomerSide.ContactUs');
});

Route::get('/products', function () {
    return view('CustomerSide.ProductsPage');
});

Route::get('/appointments', function () {
    return view('CustomerSide.AppointmentsPage');
});

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes (NO AUTH REQUIRED FOR NOW)
Route::prefix('admin')->name('admin.')->group(function() {
    // Admin Login
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');

    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Admin Profile Management
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');

    // Appointment Management
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
    Route::post('/appointments/manage', [AdminController::class, 'manageAppointments'])->name('appointments.manage');
});
