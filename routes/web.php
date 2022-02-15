<?php

use App\Http\Livewire\HouseholdBill;
use App\Http\Livewire\Commercial‌Bill;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('dashboard');
});

Route::get('/house-hold', HouseholdBill::class);
Route::get('/commercial-bill', Commercial‌Bill::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
