<?php

use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Categories - Admin & Staff
    Route::middleware('role:Admin,Staff')->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    // Products - Write operations first (Admin & Staff)
    Route::middleware('role:Admin,Staff')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Products - Read operations (Admin, Staff, Manager)
    Route::middleware('role:Admin,Staff,Manager')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    });

    // Borrowings - Admin & Staff
    Route::middleware('role:Admin,Staff')->group(function () {
        Route::resource('borrowings', BorrowingController::class)->except(['edit', 'update', 'destroy']);
        Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnItems'])->name('borrowings.return');
    });

    // Reports - Admin & Manager
    Route::middleware('role:Admin,Manager')->prefix('reports')->name('reports.')->group(function () {
        Route::get('/products', [ReportController::class, 'products'])->name('products');
        Route::get('/products/export/pdf', [ReportController::class, 'exportProductsPdf'])->name('products.export.pdf');
        Route::get('/products/export/excel', [ReportController::class, 'exportProductsExcel'])->name('products.export.excel');
        Route::get('/borrowings', [ReportController::class, 'borrowings'])->name('borrowings');
        Route::get('/borrowings/export/pdf', [ReportController::class, 'exportBorrowingsPdf'])->name('borrowings.export.pdf');
        Route::get('/borrowings/export/excel', [ReportController::class, 'exportBorrowingsExcel'])->name('borrowings.export.excel');
    });
});

require __DIR__.'/auth.php';
