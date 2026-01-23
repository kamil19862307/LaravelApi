<?php


use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json([
        'message' => 'pong',
    ]);
});

// Роут будет такой: /api/v1/customers
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);

    Route::post('invoices/bulk', [InvoiceController::class, 'bulkStore']);
});

// Users
Route::apiResource('users', UserController::class);
