<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\PageController;
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

Route::get('/', [MessageController::class, 'create'])->name('/');
Route::post('/store', [MessageController::class, 'store'])->name('store');
Route::get('/message/{message_id}', [MessageController::class, 'show'])->name('show');
Route::post('/decrypt', [MessageController::class, 'login'])->name('decrypt');
Route::post('/destroy/{id}', [MessageController::class, 'destroy']);

// Route::get('/page/{page_id}', [PageController::class, 'show'])->name('pageShow');

Route::get('/{page_id}', [PageController::class, 'index'])->name('loginForm');
Route::post('/page', [PageController::class, 'store'])->name('login');
