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

    Route::get('edit/{offer_id}', [App\Http\Controllers\CrudController::class, 'editOffer'])->name('offers.edit');
    Route::post('update/{offer_id}', [App\Http\Controllers\CrudController::class, 'updateOffer'])->name('offers.update');
    Route::get('delete/{offer_id}', [App\Http\Controllers\CrudController::class, 'delete'])->name('offers.delete');

    Route::get('all', [App\Http\Controllers\CrudController::class, 'getAllOffers'])->name('offers.all');

    Route::get('youtube', [App\Http\Controllers\CrudController::class, 'getVideo']);

});

##########Begin Ajax Routes#########

Route::group(['prefix'=>'ajax-offers'], function () {

    Route::get('create', [App\Http\Controllers\OfferController::class, 'create'])->name('ajax.offers.create');
    Route::post('store', [App\Http\Controllers\OfferController::class, 'store'])->name('ajax.offers.store');
    Route::get('all', [App\Http\Controllers\OfferController::class, 'all'])->name('ajax.offers.all');
    Route::post('delete', [App\Http\Controllers\OfferController::class, 'delete'])->name('ajax.offers.delete');
    // Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    // Route::post('update', 'OfferController@Update')->name('ajax.offers.update');

});

##########End Ajax Routes#########




