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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('users/{username?}', 'FriendController@index');
Route::post('/search', 'SearchController@index');
Route::post('/addfrend/{username?}', 'FriendController@add');
Route::post('/removefrend/{username?}', 'FriendController@remove');
