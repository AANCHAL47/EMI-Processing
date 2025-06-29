<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmiController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [LoanController::class, 'index'])->name('dashboard');

    Route::get('/emi-details', [EmiController::class, 'show'])->name('emi.index');
    Route::post('/process-emi', [EmiController::class, 'process'])->name('process-emi');
});

require __DIR__.'/auth.php';
