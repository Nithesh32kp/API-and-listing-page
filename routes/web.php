<?php

use App\View\Components\PaymentMethod;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('gallery')->group(function () {
    Route::get('/login', function () {
        return ('hellow');
    });
});
Route::get('month/{num}', function ($num) {
    if ($num == 1) {
        return 'Januvary';
    } elseif ($num == 2) {
        return 'Febuvary';
    } elseif ($num == 3) {
        return 'March';
    }
})->middleware('check.stock');
