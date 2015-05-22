<?php

class ExamController extends BaseController{
	public function __construct(){
	// 	$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('admin', array('only' => array('showAll', 'showEnableStatus', 'enableStatus')));
		$this->beforeFilter('member', array('except' => array('showAll', 'showEnableStatus', 'enableStatus')));
	}


	//views the exam blade
	public function postIndex(){
		$paper_id = Input::get('id');
		$state = DB::table('acceptances')
					->where('member_id', '=', Auth::user()->member_id)
					->where('paper_id', '=', $paper_id)
					->orderBy('created_at', 'desc')
					->first();

		return View::make('members.examinfo')
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
		$exam = Mcq::find($paper_id);
		$state = DB::table('acceptances')
					->where('member_id', '=', Auth::user()->member_id)
					->where('paper_id', '=', $paper_id)
					->orderBy('created_at', 'desc')
					->first();

		
		if($exam->type == 1){
			$accept = Acceptance::find($state->id);
			$accept->state = 5;

			$accept->save();

			$marks = new Marks;
			$marks->member_id = Auth::user()->member_id;
			$marks->acceptance_id = $state->id;
			$marks->paper_id = $paper_id;
			$marks->start_time = date('h:i:s', time());
			$marks->end_time = date('h:i:s', time());

			$marks->save();

			Session::put('marks_id', $marks->id);
			Session::put('accept_id', $accept->id);

			return View::make('members.exam')
				->with('exam', $exam);
		}
	}

	//
	// public function post(){
	// 	if(!$state){
			
	// 	}else if($state->state == 1){
	// 		return Redirect::to('members/exams')
	// 			->with('message', 'Your request to try this axamination is pending');
	// 	}else if($state->state == 2){

	// 	}else if($state->state == 3){
	// 		return Redirect::to('members/exams')
	// 			->with('message', 'You have successfully completed this examination');
	// 	}else if($state->state == 4){
	// 		$acceptance = new Acceptance;
	// 		$acceptance->state = 1;
	// 		$acceptance->member_id = Auth::user()->member_id;
	// 		$acceptance->paper_id = $paper_id;

	// 		$acceptance->save();

	// 		return Redirect::to('members/exams')
	// 					->with('message', 'Request to try the selected examination again, is sent');
	// 	}		
	// 	return Redirect::to('members/exams')
	// 			->with('message', 'Something went wrong. Please try again');
	// }

	public function postMarkresults() {
		//get the submitted answers and calculate the marks

		$j = 0;
		$answers_json = Input::get('answers');
		$answers = json_decode($answers_json, true);
		$answers_arr = array();

		foreach ($answers['answerArray'] as $level1) {

	 		$k = 0;
			foreach ($level1['optionArray'] as $level2) {

				$answers_arr[$j][$k] = $level2['state'];
				$k++;
			}
			$j++;
		}
		
		$total_questions = $correct_answers = $true_counter = $correct_counter = $i = 0;

		$paper_id = Input::get('paper_id');

		$paper = Mcq::find($paper_id)->paper;
		$paper_arr = json_decode($paper, true);

		if($answers_arr) {

			foreach ($answers_arr as $ans_level1) {


				foreach ($ans_level1 as $ans) {

					if($paper_arr['questions'][$total_questions]['options'][$true_counter]['setAnswer'] === $ans) {
						$correct_counter++;
					}
					$true_counter++;
				}

				if($true_counter === $correct_counter) {

					$correct_answers = $correct_answers+1;
				}

				$total_questions++;
				$true_counter = $correct_counter = 0;
				
			}

			$result = ($correct_answers/$total_questions)*100;

			$marks = Marks::find(Session::get('marks_id'));

			// Updating the acceptance table with the completed status
			$acceptance = Acceptance::find(Session::get('accept_id'));
			$acceptance->state = 3;
			$status = Input::get('status');
			if($status == 1){
				$acceptance->state = 4;
				Session::put('alert', 'Connection failed and session has been expired.');
			}else if($status == 2){
				Session::put('alert', 'Examination time is over.');
			}else if($status == 0){
				Session::put('alert', 'You have successfully finished the examination.');
			}

			// updating the marks table
			$marks->end_time = date('h:i:s', time());
			$marks->marks = $result;

			

			if($acceptance->save()) {

				if($marks->save()) {

					return 'success';
				}
			}
		}
	}

	public function showEnableStatus() {
		// admin views the exam details and marks

		$exams = DB::table('marks')
						->leftJoin('members', 'members.id', '=', 'marks.member_id')
						->leftJoin('acceptances', 'acceptances.id', '=', 'marks.acceptance_id')
						->select('marks.id as id', 'marks.paper_id', 'members.name', 'marks.member_id', 'state', 'marks', 'start_time', 'end_time', 'acceptance_id')						
				        ->paginate(10);

		return View::make('admin.exam.details')
			->with('exams', $exams);
	}

	public function showAll() {
		// admin accepting the requests for an exam

		$exams = DB::table('acceptances')
						->leftJoin('members', 'members.id', '=', 'acceptances.member_id')
						->select('acceptances.id as id', 'paper_id', 'members.name', 'member_id', 'state')				
				        ->paginate(10);

		return View::make('admin.exam.request')
			->with('exams', $exams);
	}


	public function enableStatus() {
		// admin accepting the requests for an exam

		$id = Input::get('id');

		$exam = Acceptance::find($id);

		if($exam) {
			
			if($exam->state === 1) {

				$exam->state = 2;
				$exam->save();

				return Redirect::to('admin/exam/showall')
					->with('message', 'Successfully Changed the Status');
			}
			
			return Redirect::to('admin/exam/showall')
				->with('message', 'Cannot Change the Status');

		}
		return Redirect::to('admin/exam/showall')
			->with('message', 'Error Occured');
	}

	public function postPooling() {
		// saves a record in the acceptance table stating the ongoing state of the exam
		$acceptances = Acceptance::find(Session::get('accept_id'));

		if($acceptances->state == 5){
			$marks = Marks::find(Session::get('marks_id'));
			$end_time = $marks->end_time;
			$curr_time = date('h:i:s', time());
			$marks->end_time = $curr_time;

			$marks->save();
			$paper = Mcq::find($marks->paper_id);
					
			if(strtotime($curr_time) - strtotime($end_time) > 60){

				return 1;
			}
			$paper = Mcq::find($marks->paper_id);
			if(strtotime($marks->end_time) - strtotime($marks->start_time) >= ($paper->duration * 60)){

				return 2;
			}
		}
		
		return 0;

		// if the state fail there will be no requests. So in the "postIndex" method, status can be set to 4
	}
}