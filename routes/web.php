<?php

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

Route::view('/', 'index');

Route::group(['middleware'=>'auth'], function() {
  Route::get('/admin', [App\Http\Controllers\CountHallController::class, 'index'])->name('admin-countHall.index');
  Route::post('/admin/countHallStore', [App\Http\Controllers\CountHallController::class, 'store'])->name('admin-countHall.store');
  Route::delete('/admin/destroy/{id}', [App\Http\Controllers\CountHallController::class, 'destroy'])->name('admin-countHall.delete');
  Route::post('/admin/schemeHallStore', [App\Http\Controllers\SchemeHallController::class, 'store'])->name('admin-schemeHall.store');
  Route::post('/admin/priceStore', [App\Http\Controllers\PriceController::class, 'store'])->name('admin-price.store');
  Route::post('/admin/movieStore', [App\Http\Controllers\MovieController::class, 'store'])->name('admin-movie.store');
  // Route::get('/admin/movieIndex', [App\Http\Controllers\MovieController::class, 'index'])->name('admin-movie.index');
});

Auth::routes();



