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

Route::get('/', function()
{
	return View::make('home.index');
});

Route::get('about', function()
{
	return View::make('about.index');
});

Route::get('news', function(){
	return View::make('news.index');
});

Route::get('contact', function(){
	return View::make('contact.index');
});

Route::resource('members', 'WorkController');

Route::controller('admin/user', 'UserController');

Route::get('member', 'MemberController@AllMembers');

Route::controller('admin/member', 'MemberController');

//route to category controller
Route::controller('admin/category', 'CategoryController');

//route to news controller
Route::controller('admin/news', 'NewsController');

//route to image controller
Route::controller('admin/image', 'ImageController');

//routes to auth controller
Route::controller('admin', 'AuthController');


