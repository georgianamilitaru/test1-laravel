<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::post('/follow/{user}', 'FollowsController@store')->name('follow.store');

Route::get('/profile/{user}', 'ProfilesController@show')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/', 'PostsController@index')->name('post.index');
Route::get('/post', 'PostsController@index')->name('post.index');
Route::get('/post/create', 'PostsController@create')->name('post.create');
Route::get('/post/{post}', 'PostsController@show')->name('post.show');
Route::post('/post', 'PostsController@store')->name('post.store');
