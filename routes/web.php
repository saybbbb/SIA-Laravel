<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;

Route::resource('suppliers', SupplierController::class);
Route::resource('waters', WaterController::class);
Route::get('/waters', [WaterController::class, 'index'])->name('waters.index');
Route::get('/suppliers', [SupplierController::class, 'index'])->name(name: 'suppliers.index');
Route::resource('transactions', TransactionController::class);
Route::get('/transactions', [TransactionController::class, 'index'])->name(name: 'transactions.index');

Route::get('/suppliers/export/pdf', [SupplierController::class, 'exportPdf'])->name('suppliers.export.pdf');
Route::get('/waters/export/pdf', [WaterController::class, 'exportPdf'])->name('waters.export.pdf');
Route::get('/transactions/export/pdf', [TransactionController::class, 'exportPdf'])->name('transactions.export.pdf');

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
});

require __DIR__.'/auth.php';
