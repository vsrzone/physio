<?php

class EssayAnswerController extends BaseController{

	public function postIndex() {
		//show the selected essay question paper

		$paper_id = Input::get('id');
		$state = DB::table('acceptances')
					->where('member_id', '=', Auth::user()->member_id)
					->where('paper_id', '=', $paper_id)
					->orderBy('updated_at', 'desc')
					->first();

		if(!$state){
			$acceptance = new Acceptance;
			$acceptance->state = 1;
			$acceptance->member_id = Auth::user()->member_id;
			$acceptance->paper_id = $paper_id;

			$acceptance->save();

			return Redirect::to('members/essays')
						->with('message', 'Request to try the selected examination is sent');
		}else if($state->state == 1){
			return Redirect::to('members/essays')
				->with('message', 'Your request to try this axamination is pending');
		}else if($state->state == 2){
			$essay = Mcq::find($paper_id);

			
			if($essay->type == 2){
				// $accept = Acceptance::find($state->id);
				// $accept->state = 5;

				// $accept->save();

				// $marks = new Marks;
				// $marks->member_id = Auth::user()->member_id;
				// $marks->acceptance_id = $state->id;
				// $marks->paper_id = $paper_id;
				// $marks->start_time = date('h:i:s', time());
				// $marks->end_time = date('h:i:s', time());
				// Session::put('mark_id', $marks->id);

				// $marks->save();

				// Session::put('marks_id', $marks->id);

				return View::make('members.essay')
					->with('essay', $essay);
			}
		}else if($state->state == 3){
			return Redirect::to('members/essays')
				->with('message', 'You have successfully completed this examination');
		}else if($state->state == 4){
			$acceptance = new Acceptance;
			$acceptance->state = 1;
			$acceptance->member_id = Auth::user()->member_id;
			$acceptance->paper_id = $paper_id;

			$acceptance->save();

			return Redirect::to('members/essays')
						->with('message', 'Request to try the selected examination again, is sent');
		}		
		return Redirect::to('members/essays')
				->with('message', 'Something went wrong. Please try again');
	}

	public function postMarkresults() {
	// save the questions and answers to essay questions in the database and send an email to the appropriate examiner.

		$j = 0;
		$answers = Input::get('answers');
		$member_id = Auth::user()->member_id;
		$paper_id = Input::get('paper_id');
		$start_time = Session::get('start_time');
		$end_time = Session::get('end_time');
		$acceptance_id = Input::get('acceptance_id');

		$essay = new Essay;

		// saving the data to the acceptance table with the completed status
		$acceptance = new Acceptance;
		$acceptance->state = 3;
		$acceptance->member_id = Auth::user()->member_id;	//**************** NEED TO DECIDE MEMBER_ID OR USER_ID *****************//
		$acceptance->paper_id = $paper_id;

		// saving the data to the marks table
		$essay->member_id =Auth::user()->member_id;	//**************** NEED TO DECIDE MEMBER_ID OR USER_ID *****************//
		$essay->start_time = date('h:i:s', time());	//**************** NEED TO FIND THE START TIME *****************//
		$essay->paper_id = $paper_id;
		$essay->end_time = date('h:i:s', time());	//**************** NEED TO FIND THE END TIME *****************//
		$essay->answers = $answers;
		$essay->acceptance_id = 3;		//**************** NEED TO FIND THE ACCEPTANCE ID *****************//

		// email attributes
		$paper_details = Mcq::find($paper_id);
		$examiners_arr = explode(",", $paper_details->examiners);
		$title = $paper_details->title;
		$member = Member::find($member_id);

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