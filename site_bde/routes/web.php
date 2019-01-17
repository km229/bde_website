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

Route::get('/', [
    'as' => 'welcome',
    'uses' => 'WelcomeController@index'
]);
Route::post('/', 'WelcomeController@index');



Route::get('login', [
    'as' => 'login',
    'uses' => 'LoginController@index'
]);


Route::get('register', [
    'as' => 'register',
    'uses' => 'RegisterController@index'
]);
Route::post('register', [
    'as' => 'register_check',
    'uses' => 'RegisterController@check'
]);



Route::get('shop', [
    'as' => 'shop',
    'uses' => 'ShopController@index'
]);



Route::get('ideas', [
    'as' => 'ideas',
    'uses' => 'IdeasController@index'
]);

Route::post('ideas', [
    'as' => 'ideas',
    'uses' => 'IdeasController@index'
]);

Route::get('ideas/create', [
    'as' => 'ideas_create',
    'uses' => 'IdeasController@create'
]);



Route::get('activities', [
    'as' => 'activities',
    'uses' => 'ActivitiesController@index'
]);



Route::get('account', 'AccountController@index');
