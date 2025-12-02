<?php

use App\Http\Controllers\Account\LoginController;
use Illuminate\Support\Facades\Route;


//regester
Route::get('/register',[\App\Http\Controllers\Account\RegesterController::class, 'create']);
Route::post('/register', [\App\Http\Controllers\Account\RegesterController::class, 'store'])
->name('register');
//regester

// login
Route::get('/login',[\App\Http\Controllers\Account\LoginController::class, 'create']);
Route::post('/login', [\App\Http\Controllers\Account\LoginController::class, 'store'])->name('login');
//login

// new password
Route::get('/newpassword',[\App\Http\Controllers\Account\NewPasswordController::class, 'index']);
Route::post('/newpassword', [\App\Http\Controllers\Account\NewPasswordController::class, 'newpassword'])->name('newpassword');
Route::get('/acceptpass/',[\App\Http\Controllers\Account\NewPasswordController::class, 'password'])->name('password');
Route::get('/acceptpass/{token}',[\App\Http\Controllers\Account\NewPasswordController::class, 'password'])->name('password');
Route::patch('/acceptpass/',[\App\Http\Controllers\Account\NewPasswordController::class, 'changepassword'])->name('changepassword');

//new password






