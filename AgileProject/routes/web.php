<?php

use Illuminate\Support\Facades\Route;


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
