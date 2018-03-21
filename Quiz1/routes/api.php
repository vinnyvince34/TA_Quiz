<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->User();
});

Route::middleware('auth:api')->get('/item', function (Request $request) {
    return $request->item();
});

Route::get('/user', 'UserController@all');
Route::get('/user/{id}', 'UserController@find');
Route::post('/user', 'UserController@register');
Route::delete('/user/{id}', 'UserController@delete');
Route::put('/user/{id}', 'UserController@update');

Route::get('/item', 'ItemController@all');
Route::get('/item/{id}', 'ItemController@find');
Route::post('/item', 'ItemController@register');
Route::delete('/item/{id}', 'ItemController@delete');
Route::put('/item/{id}', 'ItemController@update');