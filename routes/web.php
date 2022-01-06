<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile','App\Http\Controllers\ProfileController@index')->name('users.profile');
Route::put('/profile/update','App\Http\Controllers\ProfileController@update')->name('profile.update');

Route::resource('Post', 'App\Http\Controllers\PostController');
Route::get('posts/delete/{id}','App\Http\Controllers\PostController@delete')->name('posts.delete');
Route::get('posts/trash','App\Http\Controllers\PostController@trashedPosts')->name('posts.trash');
Route::get('posts/restore/{id}','App\Http\Controllers\PostController@restoreTrashed')->name('posts.restore');

Route::resource('comments','App\Http\Controllers\CommentController');
Route::get('comment/{id}','App\Http\Controllers\CommentController@index')->name('comment.index');
Route::get('reply/{id}','App\Http\Controllers\CommentController@replyIndex')->name('reply.index');
Route::post('reply','App\Http\Controllers\CommentController@replyStore')->name('reply.store');
Route::group(['middleware' => ['Admin']], function () {
    Route::resource('Tag', 'App\Http\Controllers\TagController');
    Route::resource('users' ,'App\Http\Controllers\UserController');
});

Route::group(['middleware' => ['Admin']], function () {
    Route::get('roles','App\Http\Controllers\RoleController@index')->name('roles.index');
    Route::put('roles/update/{id}','App\Http\Controllers\RoleController@update')->name('roles.update');
    Route::get('roles/edit/{id}','App\Http\Controllers\RoleController@edit')->name('roles.edit');
});

