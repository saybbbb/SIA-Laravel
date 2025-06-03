<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Models\Water;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Http\Controllers\StatisticsExportController;
use App\Http\Controllers\AdminStaffController;
use App\Models\User;

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
    $totalWaters = Water::count();
    $totalSuppliers = Supplier::count();
    $totalTransactions = Transaction::count();

    $waterUsage = Transaction::select('water_id', \DB::raw('SUM(total_water_used) as total'))
                              ->groupBy('water_id')
                              ->with('water')
                              ->get();

    $supplierUsage = Transaction::select('supplier_id', \DB::raw('SUM(total_water_used) as total'))
                                ->groupBy('supplier_id')
                                ->with('supplier')
                                ->get();

    $pendingCount = User::where('role', 'staff')->where('status', 'pending')->count();

    return view('dashboard', compact(
        'totalWaters',
        'totalSuppliers',
        'totalTransactions',
        'waterUsage',
        'supplierUsage',
        'pendingCount'  // pass pendingCount to view

    ));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/export-statistics-pdf', [StatisticsExportController::class, 'exportPDF'])
    ->middleware(['auth'])
    ->name('export.statistics.pdf');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('staff/pending', [AdminStaffController::class, 'pending'])->name('admin.staff.pending');
    Route::patch('staff/{id}/approve', [AdminStaffController::class, 'approve'])->name('admin.staff.approve');
    Route::patch('staff/{id}/reject', [AdminStaffController::class, 'reject'])->name('admin.staff.reject');
});

require __DIR__.'/auth.php';
