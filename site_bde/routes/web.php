<?php

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

Route::get('/', 'WelcomeController@index');
Route::post('/', 'WelcomeController@index');

Route::get('login', 'LoginController@index');
Route::post('login', [
    'as' => 'login',
    'uses' => 'LoginController@index'
]);

Route::get('register', 'RegisterController@index');
Route::post('register', 'RegisterController@index');

Route::get('shop', 'ShopController@index');

Route::get('ideas', 'IdeasController@index');

Route::get('activities', 'ActivitiesController@index');

Route::get('account', 'AccountController@index');
