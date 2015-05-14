<?php

class ExamController extends BaseController{
	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	public function getIndex(){
		var_dump('expression');
	}
	public function postIndex(){
		$exam = Mcq::find(Input::get('id'));
		if($exam->type == 1){
			return View::make('members.exam')
				->with('exam', $exam);
		}
		return Redirect::to('members/exams')
				->with('message', 'Something went wrong. Please try again');
	}

	public function postMarkresults() {
	// get the submitted answers and calculate the marks

		$marks_id = Input::get('marks_id');
		$total_questions = $correct_answers = $true_counter = $correct_counter = $i = 0;;

		$member_id = Input::get('member_id');
		$paper_id = Input::get('paper_id');
		$end_time = Input::get('end_time');
		$acceptance_id = Input::get('acceptance_id');

		$paper = Mcq::find($paper_id)->paper;
		$paper_arr = json_decode($paper, true);

		$answer_arr = [[true, false], [false, true], [false, true, true]];

		if($answer_arr) {

			foreach ($answer_arr as $ans_level1) {

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
			var_dump($result);
			die();
		}

		

		// var_dump($correct_answers);
		// die();
		// var_dump($answer_arr);
		// var_dump($paper_arr['questions'][1]['options'][0]['setAnswer']);

		// foreach ($paper_arr['questions'] as $level2) {

		// 	foreach ($level2['options'] as $level3) {

		// 		// var_dump($level3['setAnswer']);
		// 		// $correct_answers = $correct_answers+1;
		// 	}
		// 	$total_questions = $total_questions+1;
		// // }
		// var_dump($correct_answers);
		// die();

		
	}
}