<?php

class ExamController extends BaseController{
	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

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
}