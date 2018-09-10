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
Route::get('/nearby', 'PagesController@nearby');
Route::get('post/{post_id?}', 'PagesController@viewpost');
Route::get('/notifications/{id?}', 'PagesController@notifications')->middleware('auth');
Route::get('/notification', 'PagesController@allnotifications')->middleware('auth');
Route::get('/shouts', 'MessagesController@messages')->middleware('auth');
Route::get('/localchat', 'MessagesController@localchat');
Route::get('/aroundme', 'DashboardController@aroundme');
Route::get('/topics', 'DashboardController@topics');
Route::get('/topicchat/{id?}', 'DashboardController@topicchat');

//footer legal pages
Route::get('/about', 'PagesController@about');
Route::get('/newUserAbout', 'PagesController@newUserAbout')->middleware('auth');
Route::get('/browser', 'DashboardController@browser');
Route::get('/eula', 'PagesController@agreement');
Route::get('/poll', 'PagesController@poll');
Route::get('/dashboard', 'PagesController@dashboard');
Route::get('/apps', 'PagesController@apps');
Route::get('/donate', 'PagesController@donate');
Route::get('/legal', 'PagesController@legal');
Route::get('/suggestions', 'PagesController@suggestions')->middleware('auth');
Route::get('/support', 'PagesController@support')->middleware('auth');
Route::get('/currentuser', 'PagesController@currentuser')->middleware('auth');
Route::post('/update-location-swift/{lat?}/{long?}', 'PagesController@updateLocationSwift')->middleware('auth');
Route::post('/support-request', 'PagesController@supportrequest')->middleware('auth');
Route::post('/post/like', 'PagesController@like')->middleware('auth');
Route::post('/post/dislike', 'PagesController@dislike')->middleware('auth');
Route::post('/like', 'PagesController@like')->middleware('auth');
Route::post('/dislike', 'PagesController@dislike')->middleware('auth');
Route::post('/update-location', 'PagesController@updatelocation');
Route::post('/addTopic', 'DashboardController@addTopic');
Route::post('/sendTopicChat', 'DashboardController@sendTopicChat');

Route::post('/shouts/send', 'MessagesController@shout')->middleware('auth');

Route::post('/shouts/sendonpage', 'MessagesController@shoutonpage')->middleware('auth');
Route::post('/shouts/shoutseen', 'MessagesController@shoutSeen')->middleware('auth');
Route::post('/shouts/shoutback', 'MessagesController@shoutBack')->middleware('auth');
Route::post('/sendinvite', 'SearchController@sendinvite')->middleware('auth');
Route::post('/localchatdistance', 'MessagesController@setdistance');
Route::post('/sendlocalchat', 'MessagesController@sendlocalchat');

Route::get('/search', 'SearchController@index')->middleware('auth');
Route::post('/addfrend/{username?}', 'FriendController@add')->middleware('auth');
Route::post('/removefrend/{username?}', 'FriendController@remove')->middleware('auth');
Route::post('/blockfrend/{username?}', 'FriendController@block')->middleware('auth');
Route::post('/unblockfrend/{username?}', 'FriendController@unblock')->middleware('auth');
Route::post('/delete-post/{id?}', 'PagesController@deletepost')->middleware('auth');
Route::get('/clear-notifications', 'PagesController@clearnotifications')->middleware('auth');
Route::post('/comment', 'CommentsController@addcomment')->middleware('auth');
Route::post('/activitycomment', 'CommentsController@addactivitycomment')->middleware('auth');


Route::post('/report-post/{id?}', 'PagesController@reportpost')->middleware('auth');
Route::post('/report-comment/{id?}', 'PagesController@reportcomment')->middleware('auth');
Route::post('/delete-notification/{id?}', 'PagesController@deletenotification')->middleware('auth');

Route::post('s3-image-upload','S3ImageController@imageUploadPost')->middleware('auth');
Route::post('s3-hangout','S3ImageController@hangout')->middleware('auth');
Route::post('s3-image-edit','S3ImageController@imageEditPost')->middleware('auth');
Route::post('s3-image-upload-profilepic','S3ImageController@imageUploadProfilePic')->middleware('auth');
Route::post('first-image-upload-profilepic','S3ImageController@firstUploadProfilePic')->middleware('auth');


