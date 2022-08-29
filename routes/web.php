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

Route::get('/produk', 'Admin\ProdukController@index')->name('admin.produk');
Route::get('/create-produk-page', 'Admin\ProdukController@createPage')->name('admin.create-produk-page');
Route::post('/create-produk', 'Api\ProdukController@create')->name('admin.create-produk');
Route::get('/update-produk-page', 'Admin\ProdukController@updatePage')->name('admin.update-update-page');
Route::post('/delete/{$id}', 'Admin\ProdukController@delete')->name('admin.delete-produk');

Route::get('/penjualan', 'Admin\PenjualanController@index')->name('admin.penjualan');

Route::get('/user', 'Admin\UserController@index')->name('admin.user');
Route::get('/user-create-page', 'Admin\UserController@createPage')->name('admin.user-create-page');


