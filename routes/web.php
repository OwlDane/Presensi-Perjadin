<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerjadianFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome_simple');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/perjadian/create', [PerjadianFormController::class, 'create'])->name('perjadian.create');
    Route::post('/perjadian', [PerjadianFormController::class, 'store'])->name('perjadian.store');
    Route::get('/perjadian/history', [PerjadianFormController::class, 'history'])->name('perjadian.history');
    Route::get('/perjadian/{perjadianForm}', [PerjadianFormController::class, 'show'])->name('perjadian.show');
    Route::get('/perjadian/{perjadianForm}/edit', [PerjadianFormController::class, 'edit'])->name('perjadian.edit');
    Route::put('/perjadian/{perjadianForm}', [PerjadianFormController::class, 'update'])->name('perjadian.update');
    Route::delete('/perjadian/{perjadianForm}', [PerjadianFormController::class, 'destroy'])->name('perjadian.destroy');
});
