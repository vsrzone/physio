<?php

class EssayController extends BaseController{

	public function __construct(){
	// 	$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('admin');
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
					$user_name = Member::find($user->member_id);

					Mail::send('admin.paper.essay.sendmail', array('title' => $title, 'name' => $user_name->name), function($message) use ($user, $title, $user_name) {

						$message->to($user->email, $user_name->name)->subject($title.' Essay Question Paper Added');
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
		//delete an essay question paper

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

	public function getEssaymarking() {
		//shows the essays questions to be marked
		
		$essay_arr = array();
		$essays = DB::table('essays')
						->leftJoin('members', 'members.id', '=', 'essays.member_id')
						->leftJoin('acceptances', 'acceptances.id', '=', 'essays.acceptance_id')
						->select('essays.id as id', 'essays.paper_id', 'members.name', 'essays.member_id', 'state', 'marks', 'start_time', 'end_time', 'examiner_id')
			       		->get();

		foreach ($essays as $es) {
			if(in_array(Auth::id(), explode(',', $es->examiner_id))) {

				$essay_arr[] = $es;
			}
		}

		return View::make('admin.exam.marking')
						->with('essays', Paginator::make($essay_arr, count($essay_arr), 2));
	}

	public function postPaper() {
		//show the answers for the question member has written

		$id = Input::get('id');
		$answers = Essay::find($id)->answers;

		return View::make('admin.exam.markanswer')
						->with('answers', json_decode($answers, true))
						->with('id', $id);
	}

	public function postMarking() {
		//update the marks and examiner id in the database
		
		$id = Input::get('id');
		$marks = Input::get('marks');
		
		$examiner_id = Auth::user()->member_id;

		$essay = Essay::find($id);

		if($essay) {
			$essay->marks = $marks;
			$essay->examiner_id = $examiner_id;

			if($essay->save()) {

				return Redirect::to('admin/paper/essay/essaymarking')
					->with('message', 'Marks Added Successfully');
			}
		}
	}

	public function getChangestate() {
		//show the page for accepting the exam requests
		
		$exams = DB::table('acceptances')
						->leftJoin('members', 'members.id', '=', 'acceptances.member_id')
						->select('acceptances.id as id', 'paper_id', 'members.name', 'acceptances.member_id', 'state')
						->orderBy('state')
				        ->paginate(10);

		return View::make('admin.exam.status')
						->with('exams', $exams);
	}

	public function postChangestate() {
		//
		
		$id = Input::get('id');

		$exam = Acceptance::find($id);

		if($exam) {
			
			if($exam->state === 1) {

				$exam->state = 2;
				$exam->save();

				return Redirect::to('admin/paper/essay/changestate')
					->with('message', 'Successfully Changed the Status');
			}
			
			return Redirect::to('admin/paper/essay/changestate')
				->with('message', 'Cannot Change the Status');

		}
		return Redirect::to('admin/paper/essay/changestate')
			->with('message', 'Error Occured');
	}

	public function getFormarking() {
		//
		
		$essay_arr = array();
		$essays = DB::table('essays')
						->leftJoin('members', 'members.id', '=', 'essays.member_id')
						->leftJoin('acceptances', 'acceptances.id', '=', 'essays.acceptance_id')
						->select('essays.id as id', 'essays.paper_id', 'members.name', 'essays.member_id', 'state', 'marks', 'start_time', 'end_time', 'examiner_id')
						->where('marks', null)
			       		->get();

		foreach ($essays as $es) {
			if(in_array(Auth::id(), explode(',', $es->examiner_id))) {

				$essay_arr[] = $es;
			}
		}

		return View::make('admin.exam.marking')
						->with('essays', Paginator::make($essay_arr, count($essay_arr), 2));
	}

	public function postFormarking() {
		//
		
		$exams = DB::table('essays')
						->leftJoin('members', 'members.id', '=', 'essays.member_id')
						->where('marks', null)
				        ->paginate(10);

		return View::make('admin.exam.formarking')
						->with('exams', $exams);
	}

	public function getResults() {
		//
		
		$essay_arr = array();
		$essays = DB::table('essays')
						->leftJoin('members', 'members.id', '=', 'essays.member_id')
						->leftJoin('acceptances', 'acceptances.id', '=', 'essays.acceptance_id')
						->select('essays.id as id', 'essays.paper_id', 'members.name', 'essays.member_id', 'state', 'marks', 'start_time', 'end_time', 'examiner_id')
						->where('marks', '<>' ,'')
			       		->get();

		foreach ($essays as $es) {

			if(in_array(Auth::id(), explode(',', $es->examiner_id))) {

				$essay_arr[] = $es;
			}
		}

		return View::make('admin.exam.results')
						->with('essays', Paginator::make($essay_arr, count($essay_arr), 2));
	}

	public function postResults() {
		//

		$id = Input::get('id');
		$essay = Essay::find($id);
		$answers = $essay->answers;
		$marks = $essay->marks;

		return View::make('admin.exam.answer')
						->with('answers', json_decode($answers, true))
						->with('marks', $marks);
	}
}