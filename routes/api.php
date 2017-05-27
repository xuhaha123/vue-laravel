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

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user','UserController@create')->middleware('api');
Route::get('/user','UserController@select')->middleware('api');
Route::delete('/user/{id}','UserController@delete')->middleware('api');
Route::patch('/user','UserController@update')->middleware('api');