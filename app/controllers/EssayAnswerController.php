<?php

class EssayAnswerController extends BaseController{

	public function __construct(){

		$this->beforeFilter('member');
	}

	public function postIndex(){
		$paper_id = Input::get('id');
		$state = DB::table('acceptances')
					->where('member_id', '=', Auth::user()->member_id)
					->where('paper_id', '=', $paper_id)
					->orderBy('created_at', 'desc')
					->first();

		return View::make('members.essayinfo')
				->with('type', $state)
				->with('id', $paper_id);
	}

	//Get registered for an exam
	public function postRegister(){
		$paper_id = Input::get('id');
		$acceptance = new Acceptance;
		$acceptance->state = 1;
		$acceptance->member_id = Auth::user()->member_id;
		$acceptance->paper_id = $paper_id;

		$acceptance->save();

		return Redirect::to('members/exams')
					->with('message', 'Request to try the selected examination is sent');
	}

	//answer to a exam
	public function postAnswer(){
		$paper_id = Input::get('id');
		$essay = Mcq::find($paper_id);
		$state = DB::table('acceptances')
					->where('member_id', '=', Auth::user()->member_id)
					->where('paper_id', '=', $paper_id)
					->orderBy('created_at', 'desc')
					->first();

		
		if($essay->type == 2){
			$accept = Acceptance::find($state->id);
			$accept->state = 5;

			$accept->save();

			$essays = new Essay;
			$essays->member_id = Auth::user()->member_id;
			$essays->acceptance_id = $state->id;
			$essays->paper_id = $paper_id;
			$essays->start_time = date('h:i:s', time());
			$essays->end_time = date('h:i:s', time());

			$essays->save();

			Session::put('essay_mark_id', $essays->id);
			Session::put('essay_accept_id', $accept->id);

			return View::make('members.essay')
				->with('essay', $essay);
		}
	}

	public function postMarkresults() {
	// save the questions and answers to essay questions in the database and send an email to the appropriate examiner.

		$answers = Input::get('answers');
		$status = Input::get('status');

		// saving the data to the acceptance table with the completed status
		$acceptance = Acceptance::find(Session::get('essay_accept_id'));
		$acceptance->state = 3;
		if($status == 1){
			$acceptance->state = 4;
			Session::put('alert', 'Connection failed and session has been expired.');
		}else if($status == 2){
			Session::put('alert', 'Examination time is over.');
		}else if($status == 0){
			Session::put('alert', 'You have successfully finished the examination.');
		}
		$acceptance->save();

		// updating the essays table
		$essay = Essay::find(Session::get('essay_mark_id'));
		$essay->end_time = date('h:i:s', time());
		$essay->answers = $answers;

		// email attributes
		$paper_details = Mcq::find($essay->paper_id);
		$examiners_arr = explode(",", $paper_details->examiners);
		$essay->examiner_id = $paper_details->examiners;
		$title = $paper_details->title;
		$member = Member::find($essay->member_id);

		if($acceptance->save()) {

			if($essay->save()) {

				foreach ($examiners_arr as $ex) {
					$examiner_details = Member::find($ex);
					$examiner = DB::table('users')
									->where('member_id', $examiner_details->id)
									->first();

					//sending the email				
					Mail::send('admin.paper.essay.answers', array('title' => $title, 'name' => $examiner_details->name, 'answers' => json_decode($answers, true), 'member_name' => $member->name, 'member_id' => $member->id), function($message) use ($examiner, $examiner_details)
					{
						$message->to($examiner->email, $examiner_details->name)->subject('Essay Question Paper Available for Marking');
					});
				}
				return 'success';
			}
		}
	}

	public function postPooling() {
		// saves a record in the acceptance table stating the ongoing state of the exam
		$acceptances = Acceptance::find(Session::get('essay_accept_id'));

		if($acceptances->state == 5){
			$essay = Essay::find(Session::get('essay_mark_id'));
			$end_time = $essay->end_time;
			$curr_time = date('h:i:s', time());
			$essay->end_time = $curr_time;

			$essay->save();
			$paper = Mcq::find($essay->paper_id);
					
			if(strtotime($curr_time) - strtotime($end_time) > 60){

				return 1;
			}
			$paper = Mcq::find($essay->paper_id);
			if(strtotime($essay->end_time) - strtotime($essay->start_time) >= ($paper->duration * 60)){

				return 2;
			}
		}
		
		return 0;

		// if the state fail there will be no requests. So in the "postIndex" method, status can be set to 4
	}
}