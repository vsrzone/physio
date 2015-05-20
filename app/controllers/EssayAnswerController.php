<?php

class EssayAnswerController extends BaseController{

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

			
			if($exam->type == 2){
				$accept = Acceptance::find($state->id);
				$accept->state = 5;

				$accept->save();

				$marks = new Marks;
				$marks->member_id = Auth::user()->member_id;
				$marks->acceptance_id = $state->id;
				$marks->paper_id = $paper_id;
				$marks->start_time = date('h:i:s', time());
				$marks->end_time = date('h:i:s', time());
				//Session::put('mark_id', $marks->id);

				$marks->save();

				Session::put('essay_marks_id', $marks->id);
				Session::put('essay_accept_id', $accept->id);

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
	// save the questions and answers to essay questions in the database and send an email to the appropriate examiner.

		$answers = Input::get('answers');

		// saving the data to the acceptance table with the completed status
		$acceptance = Acceptance::find(Session::get('essay_accept_id'));
		$acceptance->state = 3;

		$acceptance->save();

		// updating the essays table
		$essay = Essay::find(Session::get('essay_mark_id'));
		$essay->end_time = date('h:i:s', time());
		$essay->answers = $answers;

		// email attributes
		$paper_details = Mcq::find($essay->paper_id);
		$examiners_arr = explode(",", $paper_details->examiners);
		$title = $paper_details->title;
		$member = Member::find($essay->member_id);

		if($acceptance->save()) {

			if($essay->save()) {

				foreach ($examiners_arr as $ex) {
					$examiner_details = Member::find($ex);
					$examiner = DB::table('users')
									->where('member_id', $examiner_details->id)
									->first();

					return View::make('admin.paper.essay.answers')
									->with('title', $title)
									->with('name', $examiner_details->name)
									->with('answers', json_decode($answers, true))
									->with('member_name', $member->name)
									->with('member_id', $member->id);

					//sending the email				
					// Mail::send('admin.paper.essay.answers', array('title' => $title, 'name' => $examiner_details->name, 'answers' => $answres, 'member_name' => $member->name, 'member_id' => $member->id), function($message) use ($examiner, $examiner_details)
					// {
					// 	$message->to($examiner->email, $examiner_details->name)->subject('Essay Question Paper Available for Marking');
					// });
				}
				
				return 'success';
			}
		}
	}
}