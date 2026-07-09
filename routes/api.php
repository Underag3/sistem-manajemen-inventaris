<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BorrowingApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Support\Facades\Route;

// Public API routes
Route::post('/login', [AuthController::class, 'login']);

// Protected API routes
Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::apiResource('products', ProductApiController::class);
    Route::apiResource('categories', CategoryApiController::class);

    Route::get('/borrowings', [BorrowingApiController::class, 'index'])->name('borrowings.index');
    Route::post('/borrowings', [BorrowingApiController::class, 'store'])->name('borrowings.store');
    Route::get('/borrowings/{borrowing}', [BorrowingApiController::class, 'show'])->name('borrowings.show');
    Route::patch('/borrowings/{borrowing}/return', [BorrowingApiController::class, 'returnItems'])->name('borrowings.return');
});
