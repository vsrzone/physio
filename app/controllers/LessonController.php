<?php

class LessonController extends BaseController{
	public function __construct(){
		$this->beforeFilter('csfr', array('on'=>'post'));
	}

	//views create page
	public function getCreate(){		
		return View::make('admin.lesson.add');
	}

	//add function
	public function postCreate(){

		$validator = Validator::make(Input::all(), Lesson::$rules);

		if($validator->passes()){

			$lesson = new Lesson;
			$lesson->topic = Input::get('topic');
			$lesson->content = Input::get('content');
			$lesson->user_id = Auth::id();
			$lesson->save();

			return Redirect::to('admin/lesson/create')
					->with('message', 'New lesson has been added successfully');
		}

		return Redirect::to('admin/lesson/create')
				->with('message', 'Following errors occurred')
				->withErrors($validator)
				->withInput();
	}

	//view availabel lessons
	public function getIndex(){
		return View::make('admin.lesson.index')
				->with('lessons', Lesson::all());
	}

	//delete function
	public function postDestroy(){
		$lesson = Lesson::find(Input::get('id'));
		if($lesson){
			$lesson->delete();

			return Redirect::to('admin/lesson/index')
					->with('message', 'Lesson has been deleted successfully');
		}

		return Redirect::to('admin/lesson/index')
					->with('message', 'Something went worng. Please try again');
	}
}