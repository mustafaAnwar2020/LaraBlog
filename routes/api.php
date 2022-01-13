<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register','App\Http\Controllers\API\registerController@register');
Route::post('login','App\Http\Controllers\API\loginController@login');


Route::middleware('auth:api')->group(function(){
    Route::resource('Posts','App\Http\Controllers\API\postsController');
    Route::resource('Profile','App\Http\Controllers\API\profileController');
    Route::get('Post/restore/{id}','App\Http\Controllers\API\postsController@restoreTrashed');
    Route::get('Post/delete/{id}','App\Http\Controllers\API\postsController@delete');
});
