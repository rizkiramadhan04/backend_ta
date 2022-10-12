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

// Auth page
Route::get('/', 'Auth\AuthController@loginPage')->name('login-page');
Route::post('/login', 'Auth\AuthController@login')->name('login');
Route::get('/forgot-password', 'Auth\AuthController@forgotPasswordPage')->name('forgot-password-page');
Route::post('/logout', 'Auth\AuthController@logout')->name('logout');

//User
Route::get('/user-create-page', 'Admin\UserController@createPage')->name('admin.user-create-page');
Route::post('/user-create', 'Admin\UserController@create')->name('admin.user-create');

//Middleware Admin
Route::prefix('admin')->middleware('admin')->group( function(){
    
    Route::get('/', 'Admin\HomeController@index')->name('admin.home');
    
    
    //Produk
    Route::get('/produk', 'Admin\ProdukController@index')->name('admin.produk');
    Route::get('/create-produk-page', 'Admin\ProdukController@createPage')->name('admin.create-produk-page');
    Route::post('/create-produk', 'Admin\ProdukController@create')->name('admin.create-produk');
    Route::get('/input-stock-produk', 'Admin\ProdukController@inputPage')->name('admin.input-stock-produk');
    Route::post('/stock-produk-list', 'Admin\ProdukController@getStockProduct')->name('admin.get-stock-product');
    Route::get('/update-produk-page/{id}', 'Admin\ProdukController@updatePage')->name('admin.update-produk-page');
    Route::post('/update-produk/{id}', 'Admin\ProdukController@update')->name('admin.update-produk');
    Route::post('/update-stock-product', 'Admin\ProdukController@updateStock')->name('admin.update-stock');
    Route::post('/delete-produk/{id}', 'Admin\ProdukController@delete')->name('admin.delete-produk');

    //Riwayat Pembelian
    Route::get('/riwayat-pembelian', 'Admin\ProdukController@riwayat')->name('admin.riwayat-pembelian');
    Route::get('/input-riwayat-pembelian', 'Admin\ProdukController@riwayatInput')->name('admin.input-riwayat-pembelian');
    Route::post('/save-riwayat', 'Admin\ProdukController@riwayatSave')->name('admin.save-riwayat');
    Route::post('/detail-riwayat', 'Admin\ProdukController@riwayatDetail')->name('admin.detail-riwayat');
    Route::post('/riwayat-delete', 'Admin\ProdukController@riwayatDelete')->name('admin.delete-riwayat');
    
    //import export
    Route::post('/import-produk', 'Import\ProdukImportController@import')->name('admin.produk.import'); 
    Route::get('/export-produk','Import\ProdukImportController@export')->name('admin.produk.export');
    Route::get('/export-penjualan','Import\PenjualanExportController@export')->name('admin.penjualan.export');
    
    
    //penjualan
    Route::get('/penjualan', 'Admin\PenjualanController@index')->name('admin.penjualan');
    
    //User
    Route::get('/user', 'Admin\UserController@index')->name('admin.user');
    Route::get('/user-update-page/{id}', 'Admin\UserController@updatePage')->name('admin.user-update-page');
    Route::post('/user-update/{id}', 'Admin\UserController@update')->name('admin.user-update');
    Route::post('/user-delete/{id}', 'Admin\UserController@delete')->name('admin.user-delete');

    //Pemasok
    Route::get('/pemasok', 'Admin\PemasokController@index')->name('admin.pemasok');
    Route::post('/get-nama-produk', 'Admin\PemasokController@getProduk')->name('get-nama-produk');
    Route::get('/pemasok-create', 'Admin\PemasokController@createPage')->name('admin.pemasok-create-page');
    Route::post('/pemasok-create', 'Admin\PemasokController@create')->name('admin.pemasok-create');
    Route::get('/pemasok-pembelian', 'Admin\PemasokController@pembelian')->name('admin.pemasok-pembelian');
    Route::post('/pembelian-create', 'Admin\PemasokController@save')->name('admin.pembelian-create');
    Route::get('/pembelian', 'Admin\PemasokController@pembelianPage')->name('admin.pembelian');
    Route::get('/pembelian-pdf/{id}', 'Admin\PemasokController@exportPdf')->name('admin.pembelian-pdf');
});

