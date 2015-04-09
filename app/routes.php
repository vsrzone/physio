<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/', function()
// {
// 	return View::make('home.index');
// });


Route::get('/', 'NewsController@latestFourNews');

Route::get('about', function()
{
	return View::make('about.index');
});

// Route::get('news', function(){
// 	return View::make('news.index');
// });

Route::post('contact', function() {

	Mail::send('contact.email', array('name'=>Input::get('name'), 'msg'=>Input::get('message')), function($message) {

	$message->from(Input::get('email'));
	$message->to('vikum@ingenslk.com', 'Vikum')->subject('Message');
	});
});


Route::get('contact', function(){
	return View::make('contact.index');
});

Route::resource('members', 'WorkController');

Route::controller('admin/user', 'UserController');

Route::controller('admin/member', 'MemberController');

//route to category controller
Route::controller('admin/category', 'CategoryController');

//route to news controller
Route::controller('admin/news', 'NewsController');

//route to image controller
Route::controller('admin/image', 'ImageController');

//routes to auth controller
Route::controller('admin', 'AuthController');

//routes to auth controller login
Route::get('member/login', 'AuthController@getLogin');

//routes to auth controller logout
Route::get('member/logout', 'AuthController@getLogout');

//route to get all categories
Route::get('categories', 'CategoryController@allCategories');

//route to get all news
//Route::get('news', 'NewsController@allNews');

//route to get all members only news
Route::get('news/member', 'NewsController@allMembersOnlyNews');

//route to search a news by id
Route::resource('news', 'NewsController');

//route to search news by category
Route::resource('news/category', 'NewsController@newsSearchByCategory');

