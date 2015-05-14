<?php

class ExamController extends BaseController{
	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	public function getIndex(){
		var_dump('expression');
	}
	public function postIndex(){
		$exam = Mcq::find(Input::get('id'));
		if($exam->type == 1){
			return View::make('members.exam')
				->with('exam', $exam);
		}
		return Redirect::to('members/exams')
				->with('message', 'Something went wrong. Please try again');
	}
}