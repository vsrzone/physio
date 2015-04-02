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

Route::controller('admin/user', 'UserController');

Route::controller('admin/member', 'MemberController');
