<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KeychainPasswordController;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [KeychainPasswordController::class, 'index']);
    Route::get('/changePassword', [ChangePasswordController::class, 'showChangePasswordForm'])->name('changePassword.index');
    Route::post('/changePassword', [ChangePasswordController::class, 'changePassword'])->name('changePassword.update');
    Route::resource('categories', CategoryController::class);
    Route::resource('keychainPasswords', KeychainPasswordController::class);
});