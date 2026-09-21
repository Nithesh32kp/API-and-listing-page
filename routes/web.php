<?php

use App\View\Components\PaymentMethod;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/payment-method', [PaymentMethod::class, 'index'])->name('payment-method');
Route::get('/login', function () {
    return view('components.login-page');
})->name('login');