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
Route::get('/categories', 'CategoryController@index');
Route::post('/categories', 'CategoryController@store');
Route::post('/products/categories', 'CategoryController@attachToCategory');

Route::get('/categories/{id}', 'ProductController@getByCategory');
Route::get('/products', 'ProductController@index');
Route::post('/products', 'ProductController@store');
Route::delete('/products/{product}', 'ProductController@destroy');
