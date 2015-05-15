<?php

class ExamController extends BaseController{
	// public function __construct(){
	// 	$this->beforeFilter('csrf', array('on'=>'post'));
	// }

	public function getIndex(){
		var_dump('expression');
	}
	public function postIndex(){
		$paper_id = Input::get('id');
		$state = DB::table('acceptances')
					->where('member_id', '=', Auth::user()->member_id)
					->where('paper_id', '=', $paper_id)
					->orderBy('created_at', 'desc')
					->first();

		if(!$state){
			$acceptance = new Acceptance;
			$acceptance->state = 1;
			$acceptance->member_id = Auth::user()->member_id;
			$acceptance->paper_id = $paper_id;

			$acceptance->save();

			return Redirect::to('members/exams')
						->with('message', 'Request to try the selected examination is sent');
		}else if($state->state == 1){
			return Redirect::to('members/exams')
				->with('message', 'Your request to try this axamination is pending');
		}else if($state->state == 2){
			$exam = Mcq::find($paper_id);

			
			if($exam->type == 1){
				// $accept = Acceptance::find($state->id);
				// $accept->state = 5;

				// $accept->save();

				// $marks = new Marks;
				// $marks->member_id = Auth::user()->member_id;
				// $marks->acceptance_id = $state->id;
				// $marks->paper_id = $paper_id;
				// $marks->start_time = date('h:i:s', time());
				// $marks->end_time = date('h:i:s', time());

				// $marks->save();

				// Session::put('marks_id', $marks->id);

				return View::make('members.exam')
					->with('exam', $exam);
			}
		}else if($state->state == 3){
			return Redirect::to('members/exams')
				->with('message', 'You have successfully completed this examination');
		}else if($state->state == 4){
			$acceptance = new Acceptance;
			$acceptance->state = 1;
			$acceptance->member_id = Auth::user()->member_id;
			$acceptance->paper_id = $paper_id;

			$acceptance->save();

			return Redirect::to('members/exams')
						->with('message', 'Request to try the selected examination again, is sent');
		}		
		return Redirect::to('members/exams')
				->with('message', 'Something went wrong. Please try again');
	}

	public function postMarkresults() {
	// get the submitted answers and calculate the marks

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

		// $marks_id = Input::get('marks_id');
		$total_questions = $correct_answers = $true_counter = $correct_counter = $i = 0;;

		$member_id = Session::get('member_id');
		$paper_id = Input::get('paper_id');
		$start_time = Session::get('start_time');
		$end_time = Session::get('end_time');
		// $acceptance_id = Input::get('acceptance_id');

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

			$marks = new Mark;

			// saving the data to the acceptance table with the completed status
			$acceptance = new Acceptance;
			$acceptance->state = 3;
			$acceptance->member_id = Auth::user()->member_id;
			$acceptance->paper_id = $paper_id;

			// saving the data to the marks table
			$marks->member_id = $member_id;
			$marks->start_time = $start_time;
			$marks->paper_id = $paper_id;
			$marks->end_time = $end_time;
			$marks->acceptance_id = $acceptance->id;
			$marks->marks = $result;

			

			if($acceptance->save()) {

				if($marks->save()) {

					return 'success';
				}
			}
		}
	}

	public function showEnableStatus() {
		// admin accepting the requests for an exam

		$acceptances = DB::table('acceptances')
                    ->orderBy('created_at', 'desc')
                    ->groupBy('member_id', 'paper_id')
                    ->having('state', '=', 1)
                    ->get();

		return View::make('admin.exam.request')
			->with('exams', $acceptances);
	}

	public function enablestatus() {
		// admin accepting the requests for an exam


	}
}