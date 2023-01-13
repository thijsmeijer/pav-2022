<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use Illuminate\Foundation\Application;
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

Route::get('/', HomeController::class)->name('home');
Route::get('movies', [MoviesController::class, 'index'])->name('movies.index');

Route::get('movies/{movie}', [MoviesController::class, 'show'])->name('movies.show');
Route::post('{list}/movie/store', [MoviesController::class, 'store'])->name('lists.movie.store');

require __DIR__.'/auth.php';
require __DIR__.'/list.php';
require __DIR__.'/profile.php';
