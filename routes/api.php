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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Auth::routes();

//Route::get('/category', 'CategoryController@index');
//Route::post('/category/add', 'CategoryController@store');

//Route::post('/category/create', 'CategoryController@store');
Route::resource('category', 'CategoryController');

//Route::get('/category', 'CategoryController@index');
//Route::post('/category/add', 'CategoryController@store');
//Route::post('/category/{category}/edit', 'CategoryController@update');
//Route::post('/category/{category}/delete', 'CategoryController@destroy');

