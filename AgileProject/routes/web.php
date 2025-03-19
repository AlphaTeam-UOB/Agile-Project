<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\AdminController;
use App\Http\Controllers\CustomerControllers\AppointmentController;
use App\Http\Controllers\AdminControllers\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\CustomerControllers\ChatbotController;

// Chatbot Webhook Route
Route::post('/chatbot', [ChatbotController::class, 'handleRequest']);
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

// Appointment Routes for Customers
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Login
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');

    // Protect these routes with authentication middleware
    Route::middleware(['auth'])->group(function () {
        // Admin Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Admin Profile Management
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

        // Admin Appointments Routes
    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');
    Route::get('/appointments/create', [AdminAppointmentController::class, 'create'])->name('admin.appointments.create');
    Route::post('/appointments', [AdminAppointmentController::class, 'store'])->name('admin.appointments.store');
    Route::get('/appointments/{appointment}/edit', [AdminAppointmentController::class, 'edit'])->name('admin.appointments.edit');
    Route::put('/appointments/{appointment}', [AdminAppointmentController::class, 'update'])->name('admin.appointments.update');
    Route::delete('/appointments/{appointment}', [AdminAppointmentController::class, 'destroy'])->name('admin.appointments.destroy');
        // Admin Logout
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
