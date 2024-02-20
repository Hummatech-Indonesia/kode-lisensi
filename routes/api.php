<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\FcmTokenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['enable.cors', 'throttle:api'])->group(function () {
    Route::middleware('payment.callback')->group(function () {
        Route::prefix('payment-callback')->group(function () {
            Route::post('invoice-paid', [CallbackController::class, 'invoiceCallback']);
        });
    });
});

Route::middleware('enable.cors')->group(function () {
    Route::post('login', [LoginController::class, 'apiLogin']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::middleware('role:admin')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'apiDashboard']);
            Route::post('logout', [LogoutController::class, 'logout']);
            Route::get('history-transaction', [TransactionController::class, 'apiHistory']);
            Route::get('preorder-transaction', [TransactionController::class, 'apiPreorder']);
            Route::post('orders/{invoice_id}', [OrderController::class, 'apiUpdate']);
            Route::put('update-fcm-token', [FcmTokenController::class, 'update']);
            Route::put('delete-fcm-token', [FcmTokenController::class, 'delete']);
        });
    });
});
