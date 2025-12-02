<?php

use App\Http\Controllers\Account\LoginController;
use App\Http\Controllers\git\RepoController;

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




Route::prefix('Repo')->middleware(\App\Http\Middleware\checklogin::class)->group(function () {



// repo
        Route::get('/',[RepoController::class, 'index'])->name('repo.index');
        Route::get('/create',[RepoController::class, 'create'])->name('repo.create');
        Route::post('/create',[RepoController::class, 'store'])->name('repo.store');
        Route::get('/edit/{id}',[RepoController::class, 'edit'])->name('repo.edit');
        Route::put('update/{id}',[RepoController::class, 'update'])->name('repo.update');
        Route::delete('/{id}',[RepoController::class, 'destroy'])->name('repo.delete');
//    end repo



//    token
    Route::get('/token/create',[\App\Http\Controllers\git\TokenController::class, 'create'])->name('repo.token.create');
    Route::post('/token/create',[\App\Http\Controllers\git\TokenController::class, 'store'])->name('repo.token.store');
    Route::get('/token',[\App\Http\Controllers\git\TokenController::class, 'index'])->name('repo.token.index');
    Route::delete('/token/{id}',[\App\Http\Controllers\git\TokenController::class, 'destroy'])->name('repo.token.destroy');
//    end token

// branchs
    Route::get('/branches/{username}/{repo}' , [\App\Http\Controllers\git\RepoSettingController::class, 'branches'])->name('repo.branches');

//    end branchs


//    commits
    Route::get('/commits/{username}/{repo}/{sha}',[\App\Http\Controllers\git\RepoSettingController::class, 'commits'])->name('repo.commits');

//    end commits

});

