<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PerjadinFormController;
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

// Admin Export Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/export/forms', [ExportController::class, 'exportForms'])->name('export.forms');
});

// User Routes (hanya untuk user biasa)
Route::middleware('user')->group(function () {
    Route::get('/perjadin/create', [PerjadinFormController::class, 'create'])->name('perjadin.create');
    Route::post('/perjadin', [PerjadinFormController::class, 'store'])->name('perjadin.store');
    Route::get('/perjadin/history', [PerjadinFormController::class, 'history'])->name('perjadin.history');
    Route::get('/perjadin/{perjadianForm}', [PerjadinFormController::class, 'show'])->name('perjadin.show');
    Route::get('/perjadin/{perjadianForm}/edit', [PerjadinFormController::class, 'edit'])->name('perjadin.edit');
    Route::put('/perjadin/{perjadianForm}', [PerjadinFormController::class, 'update'])->name('perjadin.update');
    Route::delete('/perjadin/{perjadianForm}', [PerjadianFormController::class, 'destroy'])->name('perjadin.destroy');
});
