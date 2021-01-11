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
Route::view('/', 'front.index')->middleware(['auth:sanctum']);

Auth::routes();

Route::group(['middleware' => ['admin']], function () {
    //MainCategory
    Route::get('admin/main_category', 'Controller@jsonMainCategory');

    //Status
    Route::get('admin/status', 'Controller@jsonStatus');

    Route::group(['namespace' => 'Admin'], function() {
        Route::get('/admin', 'HomeController@index')->name('admin.home');

        //Category
        Route::resource('admin/category', 'CategoryController');
        Route::get('admin/category/delete/{category}', 'CategoryController@destroy')->name('category.delete');
        Route::get('admin/categories', 'CategoryController@jsonCategory');

        // Task
        Route::resource('admin/task', 'TaskController');
        Route::get('/admin/jsonTask', 'TaskController@jsonIndex');
        Route::get('/admin/task/{task}/{comment}', 'TaskController@show');

        // Comments
        Route::get('/admin/comments', 'CommentController@commentsJson');
        Route::get('/admin/comment/{comment}', 'CommentController@setSeen');
    });

    // Users
    Route::resource('admin/user', 'UserController');
    Route::get('admin/user/delete/{user}', 'UserController@destroy')->name('user.delete');
    Route::get('/admin/setAdmin/{user}', 'UserController@setAdmin')->name('user.setAdmin');
    Route::get('/admin/users', 'UserController@jsonUsers');
    Route::get('admin/user/search/{search}', 'UserController@search');
});
