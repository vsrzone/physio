<?php

class EssayController extends BaseController{

	// public function __construct(){
	// 	$this->beforeFilter('csrf', array('on'=>'post'));
	// }

	//views create page
	public function getCreate(){
		$examiners = DB::table('members')
						->leftJoin('users', 'users.member_id', '=', 'members.id')
						->where('type', '=', 1)
						->select('members.id as member_id', 'users.id as user_id', 'members.name', 'email')						
				        ->get();
		return View::make('admin.paper.essay.add')
				->with('examiners', $examiners);
	}

	public function postCreate() {
	// save the essay questions in the mcqs table

		$title = Input::get('title');
		$description = Input::get('description');
		$hours = Input::get('hours');
		$mins = Input::get('mins');
		$paper = Input::get('paper');
		$type = Input::get('type');
		$examiners = Input::get('examiners');

		$duration = $hours*60 + $mins;

		$mcq = new Mcq;

		if($mcq) {

			$mcq->title = $title;
			$mcq->description = $description;
			$mcq->duration = $duration;
			$mcq->paper = $paper;
			$mcq->type = $type;
			$mcq->examiners = $examiners;

			$mcq->save();
			return 'success';
		}

		return 'Error occured';
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