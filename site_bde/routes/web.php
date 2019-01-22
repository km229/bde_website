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
Route::get('shop/cart/remove_{id}', [
    'as' => 'remove',
    'uses' => 'CartController@remove'
]);
Route::get('shop/cart/buy', [
    'as' => 'buy',
    'uses' => 'CartController@buy'
]);
Route::get('shop/add_{id}', [
    'as' => 'shop_add_to_cart',
    'uses' => 'ShopController@add_to_cart'
]);
Route::get('shop/{id}', [
    'as' => 'shop_id',
    'uses' => 'ShopController@id'
]);
Route::get('shop/{id}/update', [
    'as' => 'shop_id_update',
    'uses' => 'ShopController@id_update'
]);
Route::post('shop', [
    'as' => 'shop_id_update_check',
    'uses' => 'ShopController@id_update_check'
]);
Route::get('shop/{id}/delete', [
    'as' => 'shop_delete',
    'uses' => 'ShopController@delete'
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
Route::get('ideas/{id}', [
    'as' => 'idea',
    'uses' => 'IdeasController@display_idea'
]);
Route::post('ideas/{id}', [
    'as' => 'change_like',
    'uses' => 'IdeasController@change_like'
]);


/*---ACTIVITIES---*/


Route::get('activities', [
    'as' => 'activities',
    'uses' => 'ActivitiesController@index'
]);
Route::post('activities', [
    'as' => 'activities_id_update_check',
    'uses' => 'ActivitiesController@id_update_check'
]);
Route::get('activities/create', [
    'as' => 'activities_create',
    'uses' => 'ActivitiesController@create'
]);
Route::get('activities/{id}', [
    'as' => 'activities_id',
    'uses' => 'ActivitiesController@id'
]);
Route::get('activities/{id}/update', [
    'as' => 'activities_id_update',
    'uses' => 'ActivitiesController@id_update'
]);
Route::get('activities/{id}/delete', [
    'as' => 'activities_delete',
    'uses' => 'ActivitiesController@delete'
]);
Route::get('activities/{id}/join', [
    'as' => 'activities_join',
    'uses' => 'ActivitiesController@join'
]);
Route::get('activities/{id}/leave', [
    'as' => 'activities_leave',
    'uses' => 'ActivitiesController@leave'
]);
Route::get('activities/{id}/add_picture', [
    'as' => 'activities_add_picture',
    'uses' => 'ActivitiesController@add_picture'
]);
Route::post('activities/{id}', [
    'as' => 'activities_add_picture_check',
    'uses' => 'ActivitiesController@add_picture_check'
]);
Route::post('activities/create', [
    'as' => 'activities_create_check',
    'uses' => 'ActivitiesController@create_check'
]);


/*---ACCOUNT---*/


Route::get('account', [
    'as' => 'account',
    'uses' => 'AccountController@index'
]);

Route::post('account', [
    'as' => 'account_check',
    'uses' => 'AccountController@check'
]);

Route::get('account/orders', 'AccountController@orders');


/*---MENTIONS---*/


Route::get('legal', [
    'as' => 'legal',
    'uses' => 'LegalController@index'
]);
