<?php

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
Route::post('/login', 'Front\AuthController@login')->name('front.login');
Route::group(['namespace' => 'Front' ,'middleware' => ['auth:sanctum']], function () {
    Route::get('/tasks', 'TaskController@index')->name('front.task.index');
    Route::get('user', 'AuthController@user')->name('front.user');
    Route::post('logout', 'AuthController@logout')->name('front.logout');
    Route::get('/detail/{id}', 'TaskController@detail');
    Route::get('/edit/{task}', 'TaskController@editStatus');
    Route::post('/comment', 'CommentController@create');
});

