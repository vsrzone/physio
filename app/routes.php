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


Route::get('/', 'NewsController@latestNewsEvents');

Route::get('about', function()
{
	return View::make('about.index');
});

// resize an image for all news
Route::get('/thumbnail',function(){
	
	include_once(app_path().'/views/admin/image/image.php');
});

// resize an image for news slider
Route::get('/slider',function(){
	
	include_once(app_path().'/views/admin/image/slider.php');
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


Route::get('learn', function(){
	return View::make('learn.index');
});

//route to individual member edit
Route::post('member/edit', 'WorkController@editMember');

// show only one lesson
Route::get('member/lesson/{id}', 'LessonController@oneLesson');

// show all the lessons available
Route::get('members/lessons', 'LessonController@allLessons');

// Route::get('members/learning', function() {
// 	return View::make('members.learning')
// 		->with('lessons', Lesson::all());
// });

//route to exam area
Route::get('members/exams', function()
{
	if(Auth::check()){
		$marks = Marks::where('member_id', '=', Auth::user()->member_id)
					->join('mcqs', 'mcqs.id', '=', 'marks.paper_id')
					->select('marks.id as id', 'title', 'marks')
					->paginate(3);

		

		return View::make('members.exams')
				->with('exams', Mcq::where('type', 1)->paginate(5))
				->with('essays', Mcq::where('type', 2)->paginate(5))
				->with('marks', $marks);
	}

	return Redirect::to('/');
	
});

// Route::get('members/essays', function()
// {
// 	//shows all the essay questions in the database

// 	return View::make('members.essays')
// 			->with('essays', Mcq::where('type',2)->get());
// });

//route to essayAnswerController
Route::controller('members/essay','EssayAnswerController');

//route to  examcontroller 
Route::controller('members/exam', 'ExamController');

Route::resource('members', 'WorkController');

//route to managing exams for Admins
Route::get('admin/exam/enablestatus', 'ExamController@showEnableStatus');

//route to managing exams details for Admins
Route::get('admin/exam/showall', 'ExamController@showAll');

//route to mcq results for Admins
Route::get('admin/exam/results', 'ExamController@results');

//route to accepting the requests for exams
Route::post('admin/exam/postenablestatus', 'ExamController@enableStatus');

//route to questions
Route::controller('admin/paper/mcq', 'PaperController');

//route to questions
Route::controller('admin/paper/essay', 'EssayController');

Route::controller('admin/user', 'UserController');

Route::controller('admin/member', 'MemberController');

//route to category controller
Route::controller('admin/category', 'CategoryController');

//route to news controller
Route::controller('admin/news', 'NewsController');

//route to image controller
Route::controller('admin/image', 'ImageController');

//route to lessons controller
Route::controller('admin/lesson', 'LessonController');

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




