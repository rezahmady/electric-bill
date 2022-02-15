<?php

use App\Http\Controllers\Commercial‌BillController;
use App\Http\Controllers\HouseholdBillController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/house-bill', [HouseholdBillController::class, 'index']);
Route::post('/commercial-bill', [Commercial‌BillController::class, 'index']);
