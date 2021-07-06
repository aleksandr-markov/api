<?php

use App\Http\Controllers\API\CurrencyController;
use App\Http\Controllers\API\CurrencyHistoryController;
use App\Http\Controllers\API\CurrencyUserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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


Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/me', function (Request $request) {
    return response()->json(['name' => $request->user()]);
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('currencies', CurrencyController::class);
    Route::get('/currencies/user/{id}', [CurrencyUserController::class, 'show']);
    Route::post('/currencies/user', [CurrencyUserController::class, 'store']);
    Route::get('/currencies/user/{id}/history', [CurrencyHistoryController::class, 'show']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});



//Route::get('/currencies/user/{id}', [CurrencyUserController::class, 'show']);
//Route::post('/currencies/user', [CurrencyUserController::class, 'store']);
//Route::get('/currencies/user/{id}/history', [CurrencyHistoryController::class, 'show'])->middleware('auth:sanctum');
