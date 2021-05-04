<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify'=> true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Auth::routes();

Route::get('/fillable', [App\Http\Controllers\CrudController::class, 'getOffers']);

Route::group(['prefix'=>'offers'], function () {
    // Route::get('store', [App\Http\Controllers\CrudController::class, 'store']);

    Route::get('create', [App\Http\Controllers\CrudController::class, 'create'])->name('offers.create');
    Route::post('store', [App\Http\Controllers\CrudController::class, 'store'])->name('offers.store');

    Route::get('all', [App\Http\Controllers\CrudController::class, 'getAllOffers'])->name('offers.all');

});



