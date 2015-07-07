<?php

class PaperController extends BaseController{

	public function __construct(){
	// 	$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('admin');
	}

	public function getIndex() {
		// This method will show all the questions in the database
		// show 10 questions per page

		$questions = DB::table('mcqs')
					->where('type', '=', 1)
					->paginate(10);
		return View::make('admin.paper.mcq.index')
			->with('questions', $questions);
	}

	public function getCreate() {
		// This method will show the form to add the question and to add the answers to the database

		return View::make('admin.paper.mcq.add');
	}

	public function postCreate() {
		// This method will save the questions with the answers in the database
		// return "Request received";
		// die();

		$title = Input::get('title');
		$description = Input::get('description');
		$hours = Input::get('hours');
		$mins = Input::get('mins');
		$paper = Input::get('paper');
		$type = Input::get('type');

		$duration = $hours*60 + $mins;

		$mcq = new Mcq;

		if($mcq) {

			$mcq->title = $title;
			$mcq->description = $description;
			$mcq->duration = $duration;
			$mcq->paper = $paper;
			$mcq->type = $type;

			$mcq->save();
			Session::put('message', 'Paper is Successfully Created');
			return 'success';
		}

		Session::put('message', 'Error Occured');
		return 'Error occured';
	}

	public function postEdit() {
		// This method will show the question paper where user can edit anything he wants.

		$id = Input::get('id');
		$mcq = Mcq::find($id);

		return View::make('admin.paper.mcq.edit')
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
		$type = Input::get('type');

		$duration = $hours*60 + $mins;


		$mcq = Mcq::find($id);

		if($mcq) {

			$mcq->title = $title;
			$mcq->description = $description;
			$mcq->duration = $duration;
			$mcq->paper = $paper;
			$mcq->type = $type;

			if($mcq->save()) {
				Session::put('message', 'Paper is Successfully Updated');
				return 'success';
			}
		}
		Session::put('message', 'Error Occured');
		return 'fail';	
	}

	public function postDestroy() {
		// This method will delete a question paper

		$id = Input::get('id');
		
		$mcq = Mcq::find($id);

		if($mcq) {

			if($mcq->delete()) {

				return Redirect::to('admin/paper/mcq')
					->with('message', 'Paper Deleted Successfully');
			}

			return Redirect::to('admin/paper/mcq')
				->with('message', 'Error Occured');
		}

		return Redirect::to('admin/paper/mcq')
			->with('message', 'Error Occured');
	}
}