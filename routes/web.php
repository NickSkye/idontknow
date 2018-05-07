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
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('users/{username?}', 'FriendController@index')->middleware('auth');
Route::get('/settings', 'PagesController@settings')->middleware('auth');
Route::get('/me', 'PagesController@myprofile')->middleware('auth');
Route::get('/activity', 'PagesController@activity')->middleware('auth');
Route::get('post/{post_id?}', 'PagesController@viewpost')->middleware('auth');


Route::post('/search', 'SearchController@index')->middleware('auth');
Route::post('/addfrend/{username?}', 'FriendController@add')->middleware('auth');
Route::post('/removefrend/{username?}', 'FriendController@remove')->middleware('auth');
Route::post('/delete-post/{id?}', 'PagesController@deletepost')->middleware('auth');



Route::post('s3-image-upload','S3ImageController@imageUploadPost')->middleware('auth');
Route::post('s3-image-upload-profilepic','S3ImageController@imageUploadProfilePic')->middleware('auth');