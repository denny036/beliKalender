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

Route::get('penjual', 'ProdukController@index')->middleware('penjual')->name('penjual.home');
Route::get('product/create', 'ProdukController@create')->middleware('penjual')->name('product.create');
Route::post('product/store', 'ProdukController@store')->middleware('penjual')->name('product.store');
Route::get('product/edit/{id}', 'ProdukController@edit')->middleware('penjual')->name('product.edit');
Route::put('product/update/{id}', 'ProdukController@update')->middleware('penjual')->name('product.update');
Route::get('product/delete/{id}', 'ProdukController@delete')->middleware('penjual')->name('product.delete');
