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
		$examiners = DB::table('members')
						->leftJoin('users', 'users.member_id', '=', 'members.id')
						->where('type', '=', 1)
						->select('members.id as member_id', 'users.id as user_id', 'members.name', 'email')						
				        ->get();

		$id = Input::get('id');
		$essay = Mcq::find($id);
		if($essay){
			return View::make('admin.paper.essay.edit')
					->with('essay', $essay)
					->with('examiners', $examiners);
		}
		return Redirect::to('admin/paper/essay')
					->with('message', 'Something went wrong. Please try again');
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
		$examiners_arr = explode(",", $examiners);

		$duration = $hours*60 + $mins;

		$mcq = new Mcq;

		if($mcq) {

			$mcq->title = $title;
			$mcq->description = $description;
			$mcq->duration = $duration;
			$mcq->paper = $paper;
			$mcq->type = $type;
			$mcq->examiners = $examiners;



			if($mcq->save()) {

				foreach ($examiners_arr as $ex) {

					$user = User::find($ex);

					Mail::send('admin.paper.essay.sendmail', array('title' => $title), function($message) use ($user, $title) {

						$message->to($user->email, $user->name)->subject($title.' Essay Question Paper Added');
					});
				}

				return 'success';
			}

			return 'failed';
		}

		return 'Error occured';
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
		$examiners_arr = explode(",", $examiners);

		$duration = $hours*60 + $mins;


		$essay = Mcq::find($id);

		if($essay) {

			$essay->title = $title;
			$essay->description = $description;
			$essay->duration = $duration;
			$essay->paper = $paper;
			$essay->type = $type;
			$exist_examiners = $essay->examiners;	// used this varible to find the existing examiners so sending emails to them can be avoided
			$exist_examiners_arr = explode(",", $exist_examiners);
			$essay->examiners = $examiners;

			if($essay->save()) {

				foreach ($examiners_arr as $ex) {

					if(!in_array($ex, $exist_examiners_arr)) {

						$user = User::find($ex);

						Mail::send('admin.paper.essay.sendmail', array('title' => $title), function($message) use ($user, $title) {

							$message->to($user->email, $user->name)->subject($title.' Essay Question Paper Added');
						});
					}
				}

				return 'success';
			}
		}
		
		return 'fail';

	}

	public function postDestroy() {
		// This method will delete a essay question paper

		$id = Input::get('id');
		
		$mcq = Mcq::find($id);

		if($mcq) {

			if($mcq->delete()) {

				return Redirect::to('admin/paper/essay')
					->with('message', 'Paper Deleted Successfully');
			}

			return Redirect::to('admin/paper/essay')
				->with('message', 'Error Occured');
		}

		return Redirect::to('admin/paper/essay')
			->with('message', 'Error Occured');
	}
}