<?php

class QuestionController extends BaseController{

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	public function getIndex() {
		// This method will show all the questions in the database
		// show 10 questions per page

		return View::make('admin.question.view')
			->with('questions', Question::paginate(10));
	}

	public function getCreate() {
		// This method will show the form to add the question and to add the answers to the database

		return View::make('admin.question.add');
	}

	public function postCreate() {
		// This method will save the questions with the answers in the database

		$question = Input::get('question');
		$option1 = Input::get('option1');
		$option2 = Input::get('option2');
		$option3 = Input::get('option3');
		$option4 = Input::get('option4');
		$answer = Input::get('answer');

		//
	}
}