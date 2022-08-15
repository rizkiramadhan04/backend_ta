<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/get-produk', 'Api\ProdukController@index')->name('api.get-produk');
Route::post('/insert-produk', 'Api\ProdukController@create')->name('api.create-produk');
Route::post('/update-produk', 'Api\ProdukController@update')->name('api.update-produk');
Route::post('/delete-produk', 'Api\ProdukController@delete')->name('api.delete-produk');