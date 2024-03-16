<?php

use App\Http\Controllers\API\TransactionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('clientes/{customerId}')->group(function () {
    Route::get('/extrato', [TransactionsController::class, 'index']);
    Route::post('/transacoes', [TransactionsController::class, 'store']);
});
