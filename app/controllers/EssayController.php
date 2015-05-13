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
}