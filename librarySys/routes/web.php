<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

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


Route::get('/books', [BookController::class, 'index']);

Route::get('/books/{slug}', [BookController::class, 'show']);

Route::get('/', function () {
    return redirect('/books');
});

Route::get('/loans', [LoanController::class, 'index']);
Route::get('/loans/create', [LoanController::class, 'create']);
Route::post('/loans', [LoanController::class, 'store']);
Route::post('/loans/{loan}/return', [LoanController::class, 'markReturned']);
