<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [BooksController::class, 'index'])->name('dashboard');

    Route::get('/book', [BooksController::class, 'add']);
    Route::post('/book', [BooksController::class, 'create']);

    Route::get('/authors', [BooksController::class, 'seeAuthors']);

    Route::get('/book/{book}', [BooksController::class, 'edit']);
    Route::get('/book/details/{book}', [BooksController::class, 'details']);
    Route::post('/book/{book}', [BooksController::class, 'update']);


});
