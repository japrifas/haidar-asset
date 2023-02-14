<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:web'])->group(function () {
        Route::view('/login', 'back.pages.auth.login')->name('login');
        Route::view('/forgot-password', 'back.pages.auth.forgot')->name('forgot-password');
        Route::get('/password/reset/{token}', [AdminController::class, 'ResetPasswordForm'])->name('reset-password-form');
    });

    Route::middleware(['auth:web'])->group(function () {
        Route::get('/home', [AdminController::class, 'index'])->name('home');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::view('/profile', 'back.pages.profile')->name('profile');
        Route::post('/change-profile-picture', [AdminController::class, 'changeProfilePicture'])->name('change-profile-picture');
        Route::view('/users', 'back.pages.users')->name('users');
        Route::view('/roles', 'back.pages.roles')->name('roles');
        Route::view('/permissions', 'back.pages.permissions')->name('permissions');
        Route::view('/assets', 'back.pages.assets')->name('assets');
        Route::view('/manufactures', 'back.pages.manufactures')->name('manufactures');
        Route::view('/employees', 'back.pages.employees')->name('employees');
        Route::view('/organizations', 'back.pages.organizations')->name('organizations');
    });
});
