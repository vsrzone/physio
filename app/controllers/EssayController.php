<?php

class EssayController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	//views create page
	public function getCreate(){
		return View::make('admin.paper.essay.add');
	}

	public function postEdit() {
	// show the edit form for question edit

		$id = Input::get('id');
		$essay = Mcq::find($id);

		return View::make('admin.paper.essay.edit')
			->with('essays', $essay);
	}

	public function postUpdate() {
	// update the essay question selected

		$id = Input::get('id');
		$title = Input::get('title');
		$description = Input::get('description');
		$hours = Input::get('hours');
		$mins = Input::get('mins');
		$paper = Input::get('paper');
		$type = Input::get('type');
		$examiners = Input::get('examiners');

		$duration = $hours*60 + $mins;


		$essay = Mcq::find($id);

		if($essay) {

			$essay->title = $title;
			$essay->description = $description;
			$essay->duration = $duration;
			$essay->paper = $paper;
			$essay->type = $type;
			$essay->examiners = $examiners;

			if($mcq->save()) {

				return 'success';
			}
		}
		
		return 'fail';
	}
}