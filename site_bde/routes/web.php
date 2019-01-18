<?php

/*---WELCOME---*/

Route::get('/', [
    'as' => 'welcome',
    'uses' => 'WelcomeController@index'
]);
Route::post('/', 'WelcomeController@index');


/*---LOGIN---*/


Route::get('login', [
    'as' => 'login',
    'uses' => 'LoginController@index'
]);
Route::post('login', [
    'as' => 'login_check',
    'uses' => 'LoginController@check'
]);
Route::get('logout', [
    'as' => 'logout',
    'uses' => 'LoginController@logout'
]);


/*---REGISTER---*/


Route::get('register', [
    'as' => 'register',
    'uses' => 'RegisterController@index'
]);
Route::post('register', [
    'as' => 'register_check',
    'uses' => 'RegisterController@check'
]);


/*---SHOP---*/


Route::get('shop', [
    'as' => 'shop',
    'uses' => 'ShopController@index'
]);
Route::get('shop/add', [
    'as' => 'shop_add',
    'uses' => 'ShopController@add'
]);
Route::post('shop/add', [
    'as' => 'shop_add_check',
    'uses' => 'ShopController@add_check'
]);
Route::get('shop/cart', [
    'as' => 'cart',
    'uses' => 'CartController@index'
]);


/*---IDEAS---*/


Route::get('ideas', [
    'as' => 'ideas',
    'uses' => 'IdeasController@index'
]);
Route::get('ideas/create', [
    'as' => 'ideas_create',
    'uses' => 'IdeasController@create'
]);
Route::post('ideas/create', [
    'as' => 'ideas_create_check',
    'uses' => 'IdeasController@create_check'
]);


/*---ACTIVITIES---*/


Route::get('activities', [
    'as' => 'activities',
    'uses' => 'ActivitiesController@index'
]);
Route::get('activities/create', [
    'as' => 'activities_create',
    'uses' => 'ActivitiesController@create'
]);
Route::post('activities/create', [
    'as' => 'activities_create_check',
    'uses' => 'ActivitiesController@create_check'
]);


/*---ACCOUNT---*/


Route::get('account', 'AccountController@index');


/*---MENTIONS---*/


Route::get('legal', [
    'as' => 'legal',
    'uses' => 'LegalController@index'
]);