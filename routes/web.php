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

define('PAGINATION_COUNT', 4);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return 'Not Adault';
})->name('not.adault');

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
    Route::get('get-all-inactive-offer', [App\Http\Controllers\CrudController::class, 'getAllInactiveOffers'])->name('offers.inactive');

    Route::get('youtube', [App\Http\Controllers\CrudController::class, 'getVideo'])->middleware('auth');

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


##################### Begin Authentication && Guards ##############

Route::group(['middleware' => 'CheckAge'], function () {
    Route::get('adaults', [App\Http\Controllers\CustomAuthController::class, 'adault'])->name('adault');
});

Route::get('site', [App\Http\Controllers\CustomAuthController::class, 'site'])->middleware('auth:web')->name('site');
Route::get('admin', [App\Http\Controllers\CustomAuthController::class, 'admin'])->middleware('auth:admin')->name('admin');

Route::get('admin/login', [App\Http\Controllers\CustomAuthController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/login', [App\Http\Controllers\CustomAuthController::class, 'checkAdminLogin'])->name('save.admin.login');


################### Begin relations  routes ######################

Route::get('has-one', [App\Http\Controllers\Relation\RelationsController::class, 'hasOneRelation']);

// Route::get('has-one-reserve','Relation\RelationsController@hasOneRelationReverse');

// Route::get('get-user-has-phone','Relation\RelationsController@getUserHasPhone');

// Route::get('get-user-has-phone-with-condition','Relation\RelationsController@getUserWhereHasPhoneWithCondition');

// Route::get('get-user-not-has-phone','Relation\RelationsController@getUserNotHasPhone');


################### End relations  routes ######################

#######################  Begin accessors and mutators ###################

Route::get('offers/accessors', [App\Http\Controllers\CrudController::class, 'getAllOffersByAccessorAndMutator'])->name('offers.accessor'); //get data

#######################  End accessors and mutators ###################


