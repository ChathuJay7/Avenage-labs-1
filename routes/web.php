<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginPage'])->name('login')->middleware('guest');;
Route::get('/register', [AuthController::class, 'registerPage']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth'])->group(function () {
   
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::post('/store', [UserController::class, 'store'])->name('store.order');
    Route::get('/orders', [UserController::class, 'showOrders'])->name('show.orders');
    Route::get('/statistics', [UserController::class, 'statistics'])->name('statistics.index');
});


