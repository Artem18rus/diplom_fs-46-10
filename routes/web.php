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
  Route::get('/admin', [App\Http\Controllers\HallController::class, 'index'])->name('admin-hall.index');
  Route::post('/admin/store', [App\Http\Controllers\HallController::class, 'store'])->name('admin-hall.store');
  Route::delete('/admin/destroy/{id}', [App\Http\Controllers\HallController::class, 'destroy'])->name('admin-hall.delete');  
});

Route::post('/admin/edit', [App\Http\Controllers\HallController::class, 'edit'])->name('hall.edit');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

