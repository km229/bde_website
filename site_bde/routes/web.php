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
Route::get('shop/add/product', [
    'as' => 'shop_add_product',
    'uses' => 'ShopController@add_product'
]);
Route::post('shop/add/product', [
    'as' => 'shop_add_product_check',
    'uses' => 'ShopController@add_product_check'
]);
Route::get('shop/add/category', [
    'as' => 'shop_add_category',
    'uses' => 'ShopController@add_category'
]);
Route::post('shop/add/category', [
    'as' => 'shop_add_category_check',
    'uses' => 'ShopController@add_category_check'
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
Route::get('account/orders', 'AccountController@orders');


/*---MENTIONS---*/


Route::get('legal', [
    'as' => 'legal',
    'uses' => 'LegalController@index'
]);