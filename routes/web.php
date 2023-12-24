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

Route::get('/', function () {
    return redirect('/sr');
});
Route::post('/hall', [App\Http\Controllers\ClientMovieController::class, 'store'])->name('client-movie.store');
// Route::get('/pn', [App\Http\Controllers\ClientMovieController::class, 'index'])->name('client-pn.index');
// Route::get('/vt', [App\Http\Controllers\ClientMovieController::class, 'index'])->name('client-vt.index');
// Route::get('/sr', [App\Http\Controllers\ClientMovieController::class, 'index'])->name('client-sr.index');
// Route::get('/ct', [App\Http\Controllers\ClientMovieController::class, 'index'])->name('client-ct.index');
// Route::get('/pt', [App\Http\Controllers\ClientMovieController::class, 'index'])->name('client-pt.index');
// Route::get('/sb', [App\Http\Controllers\ClientMovieController::class, 'index'])->name('client-sb.index');
Route::get('/pn', function(){
  return view('client/pn');
})->name('client-pn.index');
Route::get('/vt', function(){
  return view('client/vt');
})->name('client-vt.index');
Route::get('/sr', function(){
  return view('client/sr');
})->name('client-sr.index');
Route::get('/ct', function(){
  return view('client/ct');
})->name('client-ct.index');
Route::get('/pt', function(){
  return view('client/pt');
})->name('client-pt.index');
Route::get('/sb', function(){
  return view('client/sb');
})->name('client-sb.index');


Route::post('/payment', [App\Http\Controllers\PickChairController::class, 'store'])->name('client-payment.store');
Route::post('/ticket', [App\Http\Controllers\PickChairController::class, 'show'])->name('client-payment.show');

Route::post('/status', [App\Http\Controllers\StatusPageController::class, 'index'])->name('client-status.index');