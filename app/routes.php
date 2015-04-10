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

// resize an image for all news
Route::get('/thumbnail',function(){
	
	include_once(app_path().'\views\admin\image\image.php');
});

// resize an image for news slider
Route::get('/slider',function(){
	
	include_once(app_path().'\views\admin\image\slider.php');
});

// Route::get('news', function(){
// 	return View::make('news.index');
// });

Route::post('contact', function() {

	$validator = Validator::make(array('name' => Input::get('name'), 'message' => Input::get('message'), 'email' => Input::get('email')), array('name' => 'required', 'message' => 'required', 'email' => 'required|email'));

	if($validator->passes()) {

		try {

			Mail::send('contact.email', array('name'=>Input::get('name'), 'msg'=>Input::get('message'), 'email'=>Input::get('email'), 'phone'=>Input::get('phone')), function($message) {

				$message->to('secretarygpa@gmail.com', 'Vikum')->subject('Physio Contact Message');
			});
			return Redirect::to('contact')
				->with('message', 'Email Sent');
		} catch(Exception $ex) {
			return Redirect::to('contact')
				->with('message', 'Error occured');
		}
	}
	return Redirect::to('contact')
				->withErrors($validator)
				->withInput();
	
});


Route::get('contact', function(){
	return View::make('contact.index');
});

//route to individual member edit
Route::post('member/edit', 'WorkController@editMember');

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


