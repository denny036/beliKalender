<?php

use App\Http\Controllers\ProdukController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Verification
Route::get('/verification', 'UserController@verification')->name('verification')->middleware('throttle:60,1');
Route::post('/send/verification', 'UserController@sendOTP')->name('send.verification');
Route::post('/resend/verification', 'UserController@resendOTP')->name('resend.verification')->middleware('throttle:60,1');

Route::group(['middleware' => ['penjual']], function(){
    Route::get('penjual', 'ProdukController@index')->middleware('penjual')->name('penjual.home');
    Route::get('product/create', 'ProdukController@create')->middleware('penjual')->name('product.create');
    Route::post('product/store', 'ProdukController@store')->middleware('penjual', 'throttle:60,1')->name('product.store');
    Route::get('product/edit/{id}', 'ProdukController@edit')->middleware('penjual')->name('product.edit');
    Route::put('product/update/{id}', 'ProdukController@update')->middleware('penjual', 'throttle:60,1')->name('product.update');
    Route::get('product/delete/{id}', 'ProdukController@delete')->middleware('penjual')->name('product.delete');
});

Route::get('pembeli', 'Pembeli\PembeliController@index')->middleware('pembeli')->name('pembeli.index');
Route::get('pembeli/add-to-carts/{id}', 'Pembeli\PembeliController@addToCarts')->middleware('pembeli')->name('pembeli.add-to-carts');
Route::post('pembeli/add-to-carts/create/{id}', 'Pembeli\PembeliController@createAddToCarts')->middleware('pembeli')->name('create.add-to-carts');

Route::get('pembeli/carts', 'Pembeli\PembeliController@viewCarts')->middleware('pembeli')->name('pembeli.carts');
Route::post('pembeli/confirmation/checkout', 'Pembeli\PembeliController@checkout')->middleware('pembeli')->name('pembeli.checkout');

Route::delete('pembeli/checkout/delete/{id}', 'Pembeli\PembeliController@deleteFromCarts')->middleware('pembeli')->name('pembeli.delete-from-carts');

