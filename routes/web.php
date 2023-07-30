<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return view('welcome');
})->name(name:  'home');


Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/login', function () {
    return view('login')->name('login');
});

Route::get('/loginPost', function () {
    return view('loginPost');
})->name('login.post');

Route::get('/registration', function () {
    return view('registration');
});

//  Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
//  Route::post('/registration', [AuthController::class, 'registrationPost'])->name('registration.post');