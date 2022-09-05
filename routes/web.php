<?php

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

Route::get('/admin', 'Admin\HomeController@index')->name('admin.home');

//Produk
Route::get('/produk', 'Admin\ProdukController@index')->name('admin.produk');
Route::get('/create-produk-page', 'Admin\ProdukController@createPage')->name('admin.create-produk-page');
Route::post('/create-produk', 'Admin\ProdukController@create')->name('admin.create-produk');
Route::get('/input-stock-produk', 'Admin\ProdukController@inputPage')->name('admin.input-stock-produk');
Route::post('/input-stock-produk', 'Admin\ProdukController@getStockProduct')->name('admin.get-stock-product');
Route::get('/update-produk-page/{id}', 'Admin\ProdukController@updatePage')->name('admin.update-produk-page');
Route::post('/update-produk/{id}', 'Admin\ProdukController@update')->name('admin.update-produk');
Route::post('/delete-produk/{id}', 'Admin\ProdukController@delete')->name('admin.delete-produk');

//import export
Route::post('/import-produk', 'Import\ProdukImportController@import')->name('admin.produk.import'); 
Route::get('/export-produk','Import\ProdukImportController@export')->name('admin.produk.export');
Route::get('/export-penjualan','Import\PenjualanExportController@export')->name('admin.penjualan.export');


//penjualan
Route::get('/penjualan', 'Admin\PenjualanController@index')->name('admin.penjualan');

//User
Route::get('/user', 'Admin\UserController@index')->name('admin.user');
Route::get('/user-create-page', 'Admin\UserController@createPage')->name('admin.user-create-page');
Route::post('/user-create', 'Admin\UserController@create')->name('admin.user-create');
Route::get('/user-update-page/{id}', 'Admin\UserController@updatePage')->name('admin.user-update-page');
Route::post('/user-update/{id}', 'Admin\UserController@update')->name('admin.user-update');
Route::post('/user-delete/{id}', 'Admin\UserController@delete')->name('admin.user-delete');


