<?php

class EssayController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

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

	public function getIndex() {
		// This method will show all the questions in the database
		// show 10 questions per page

		$questions = DB::table('mcqs')
					->where('type', '=', 2)
					->paginate(10);
		return View::make('admin.paper.essay.index')
			->with('questions', $questions);
	}

	public function postEdit() {
		// This method will show the question paper where user can edit anything he wants.

		$id = Input::get('id');
		$essay = Mcq::find($id);
		if($essay){
			return View::make('admin.paper.essay.edit')
					->with('essay', $essay);
		}
		return Redirect::to('admin/paper/essay')
					->with('message', 'Something went wrong. Please try again');
	}
}