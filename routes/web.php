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

Route::view('/', 'index');

Route::group(['middleware'=>'auth'], function() {
  Route::get('/admin', [App\Http\Controllers\CountHallController::class, 'index'])->name('admin-countHall.index');
  Route::post('/admin/countHallStore', [App\Http\Controllers\CountHallController::class, 'store'])->name('admin-countHall.store');
  Route::delete('/admin/destroy/{id}', [App\Http\Controllers\CountHallController::class, 'destroy'])->name('admin-countHall.delete');
  Route::post('/admin/schemeHallStore', [App\Http\Controllers\SchemeHallController::class, 'store'])->name('admin-schemeHall.store');
  Route::post('/admin/priceStore', [App\Http\Controllers\PriceController::class, 'store'])->name('admin-price.store');
  // Route::post('/admin/movieStore', [App\Http\Controllers\MovieController::class, 'store'])->name('admin-movie.store');
  // Route::get('/admin/movieStore', [App\Http\Controllers\MovieController::class, 'create']);
  Route::post('/admin/movieStore', [App\Http\Controllers\MovieController::class, 'store']);

  // Route::get('/admin/seanceIndex', [App\Http\Controllers\SeanceController::class, 'index']);
  Route::post('/admin/add_seance', [App\Http\Controllers\SeanceController::class, 'store']);
  Route::delete('/admin/deleteAllSeance', [App\Http\Controllers\SeanceController::class, 'destroy'])->name('admin-deleteAllSeance.delete');;
});

// Route::get('/admin/2', function() {
//   $hall = Hall::all();
//   $seance = Seance::all();
//   //dd($seance);
//   $h = Hall::find(27);
//   // dd($h->sea);
//   // $s = Seance::find(74);
//   // dd($s->sean);
//     $j = Seance::find(72);
//     dd($j->sean);
// });


Auth::routes();



