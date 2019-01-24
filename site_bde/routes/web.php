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

/*---CART---*/

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
Route::get('shop/cart/plus_{id}', [
    'as' => 'increment',
    'uses' => 'CartController@increment'
]);
Route::get('shop/cart/minus_{id}', [
    'as' => 'decrement',
    'uses' => 'CartController@decrement'
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
Route::get('ideas/{id}/delete', [
    'as' => 'idea_delete',
    'uses' => 'IdeasController@idea_delete'
]);
Route::get('ideas/{id}/update', [
    'as' => 'idea_update',
    'uses' => 'IdeasController@idea_update'
]);
Route::post('ideas/{id}/update', [
    'as' => 'idea_update_check',
    'uses' => 'IdeasController@idea_update_check'
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
Route::post('activities/create', [
    'as' => 'activities_create_check',
    'uses' => 'ActivitiesController@create_check'
]);


Route::get('activities/{id}', [
    'as' => 'activities_id',
    'uses' => 'ActivitiesController@id'
]);
Route::post('activities/{id}', [
    'as' => 'activities_add_picture_check',
    'uses' => 'ActivitiesController@add_picture_check'
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


Route::get('activities/{id}/img_{id2}', [
    'as' => 'activities_picture',
    'uses' => 'ActivitiesController@picture'
]);
Route::post('activities/{id}/img_{id2}', [
    'as' => 'activities_picture_check',
    'uses' => 'ActivitiesController@picture_check'
]);
Route::get('activities/{id}/img_{id2}/delete', [
    'as' => 'activities_picture_delete',
    'uses' => 'ActivitiesController@picture_delete'
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


Route::get('legal_terms', [
    'as' => 'legal',
    'uses' => 'LegalController@legal'
]);
Route::get('terms_conditions', [
    'as' => 'legal',
    'uses' => 'LegalController@terms'
]);
