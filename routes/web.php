<?php

use Illuminate\Support\Facades\Route;
use App\Models\Movie;
use App\Models\Seance;
use App\Models\Hall;

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

// Route::view('/', '/client/client');

Route::group(['middleware'=>'auth'], function() {
  Route::get('/admin', [App\Http\Controllers\CountHallController::class, 'index'])->name('admin-countHall.index');
  Route::post('/admin/countHallStore', [App\Http\Controllers\CountHallController::class, 'store'])->name('admin-countHall.store');
  Route::delete('/admin/destroy/{id}', [App\Http\Controllers\CountHallController::class, 'destroy'])->name('admin-countHall.delete');
  Route::post('/admin/schemeHallStore', [App\Http\Controllers\SchemeHallController::class, 'store'])->name('admin-schemeHall.store');
  Route::post('/admin/priceStore', [App\Http\Controllers\PriceController::class, 'store'])->name('admin-price.store');
  Route::post('/admin/movieStore', [App\Http\Controllers\MovieController::class, 'store']);

  Route::post('/admin/add_seance', [App\Http\Controllers\SeanceController::class, 'store']);
  Route::delete('/admin/deleteAllSeance', [App\Http\Controllers\SeanceController::class, 'destroy'])->name('admin-deleteAllSeance.delete');
});
Auth::routes();

Route::get('/admin/2', function() {
  // $hal = Hall::find(35);
  // dump($hal->movies);
  // foreach ($hal->movies as $mov) {
  //     dump($mov);
  // }
  $mov = Movie::find(67);
  dump($mov->halls);
});

Route::get('/', [App\Http\Controllers\ClientMovieController::class, 'index'])->name('client-movie.index');



