<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

Route::group(['middleware' => ['redirAdmin']], function(){
    // Root Redirect
    Route::get('/', function(){
        return redirect()->route('login');
    });
    // Login
    Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@getLogin']);
    Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@postLogin']);
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function(){
    // Root Redirect
    Route::get('/', function(){
        return redirect()->route('admin');
    });
    // Admin Home
    Route::get('/home', ['as' => 'admin', 'uses' => 'AdminController@getHome']);
});
