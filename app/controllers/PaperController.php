<?php

class PaperController extends BaseController{

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	public function getIndex() {
		// This method will show all the questions in the database
		// show 10 questions per page

		return View::make('admin.question.index')
			->with('questions', Mcq::paginate(10));
	}

	public function getCreate() {
		// This method will show the form to add the question and to add the answers to the database

		return View::make('admin.question.add');
	}

	public function postCreate() {
		// This method will save the questions with the answers in the database

		$title = Input::get('title');
		$description = Input::get('description');
		$hours = Input::get('hours');
		$mins = Input::get('mins');
		$paper = Input::get('paper');

		$duration = $hours*60 + $mins;

		$validator = Valiator::make(array('title' => $title, 'paper' => $paper), Mcq::$rules);

		if($validator->passes()) {

			$mcq = new Mcq;

			if($mcq) {

				$mcq->title = $title;
				$mcq->description = $description;
				$mcq->duration = $duration;
				$mcq->paper = $paper;

				if($mcq->save()) {

					return Redirect::to('admin/paper')
						->with('message', 'Paper Created Successfully');
				}
			}
		}

		return Redirect::to('admin/paper/create')
			->withErrors($validator)
			->withInput();
	}

	public function getEdit() {
		// This method will show the question paper where user can edit anything he wants.

		$id = Input::get('id');
		$mcq = Mcq::find($id);

		return View::make('admin.question.edit')
			->with('mcq', $mcq);
	}

	public function postUpdate() {
		// This method will update the question paper

		$id = Input::get('id');
		$title = Input::get('title');
		$description = Input::get('description');
		$hours = Input::get('hours');
		$mins = Input::get('mins');
		$paper = Input::get('paper');

		$duration = $hours*60 + $mins;

		$validator = Valiator::make(array('title' => $title, 'paper' => $paper), Mcq::$rules);

		if($validator->passes()) {

			$mcq = Mcq::find($id);

			if($mcq) {

				$mcq->title = $title;
				$mcq->description = $description;
				$mcq->duration = $duration;
				$mcq->paper = $paper;

				if($mcq->save()) {

					return Redirect::to('admin/paper')
						->with('message', 'Paper Edited Successfully');
				}
			}
		}

		return Redirect::to('admin/paper')
			->withErrors($validator)
			->withInput();
	}

	public function postDestroy() {
		// This method will delete a question paper

		$id = Input::get('id');
		
		$mcq = Mcq::find($id);

		if($mcq) {

			if($mcq->delete()) {

				return Redirect::to('admin/paper')
					->with('message', 'Paper Deleted Successfully');
			}

			return Redirect::to('admin/paper')
				->with('message', 'Error Occured');
		}

		return Redirect::to('admin/paper')
			->with('message', 'Error Occured');
	}
}