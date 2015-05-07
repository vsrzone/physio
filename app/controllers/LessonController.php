<?php

class LessonController extends BaseController{
	public function __construct(){
		$this->beforeFilter('csfr', array('on'=>'post'));
	}

	//views create page
	public function getCreate(){		
		return View::make('admin.lesson.add');
	}

	//add function
	public function postCreate(){
			$lesson = new Lesson;
			$lesson->topic = Input::get('topic');
			$lesson->content = Input::get('content');
			$lesson->user_id = Auth::id();
			$lesson->save();

			return $lesson->id;
		}

	//view availabel lessons
	public function getIndex(){
		return View::make('admin.lesson.index')
				->with('lessons', Lesson::all());
	}

	//delete function
	public function postDestroy(){
		$lesson = Lesson::find(Input::get('id'));
		if($lesson){
			while($attach = DB::table('attachments')->where('lesson_id', '=', $lesson->id)->first()){
				$path = 'uploads/files/'.$attach->file;
				if(file_exists($path)){
					unlink($path);
					DB::table('attachments')->where('id', '=', $attach->id)->delete();
				}
			}
			$lesson->delete();

			return Redirect::to('admin/lesson/index')
					->with('message', 'Lesson has been deleted successfully');
		}

		return Redirect::to('admin/lesson/index')
					->with('message', 'Something went worng. Please try again');
	}

	//views edit page
	public function postEdit(){
		$lesson = Lesson::find(Input::get('id'));
		if($lesson){
			return View::make('admin.lesson.edit')
				->with('lesson', $lesson);
		}
		
		return Redirect::to('admin/lesson/index')
					->with('message', 'Something went worng. Please try again');
	}

	//update function
	public function postUpdate(){
		$lesson = Lesson::find(Input::get('id'));
		if($lesson){
			$validator = Validator::make(Input::all(), Lesson::$rules);

			if($validator->passes()){

				$lesson->topic = Input::get('topic');
				$lesson->content = Input::get('content');
				$lesson->user_id = Auth::id();
				$lesson->save();

				return Redirect::to('admin/lesson/create')
						->with('message', 'Lesson has been updated successfully');
			}

			return Redirect::to('admin/lesson/create')
					->with('message', 'Following errors occurred')
					->withErrors($validator)
					->withInput();
		}

		return Redirect::to('admin/lesson/index')
					->with('message', 'Something went worng. Please try again');
	}

	//uploads file to server and saves details to database
	public function postFileupload(){
		$target_dir = "uploads/files/";
		$title = basename($_FILES["files"]["name"]);
		$file_name = time().(Input::get('id')+1).'.'.pathinfo($title, PATHINFO_EXTENSION);
		$target_file = $target_dir . $file_name;
		$uploadOk = 1;
		 // Check file size
		if ($_FILES["files"]["size"] > 2000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {

		        $attach = new Attachment;
		        $attach->title = $title;
		        $attach->file = $file_name;
		        $attach->lesson_id = Input::get('lesson_id');
		        $attach->save();

		        return $attach->id;
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}

	//to add more files to a lesson
	public function postAddfiles(){
		$lesson = Lesson::find(Input::get('id'));
		if($lesson){
			$attach = DB::table('attachments')->where('lesson_id', '=', $lesson->id)->get();
			return View::make('admin.lesson.addfiles')
				->with('lesson_id', $lesson->id)
				->with('attaches', $attach);
		}
		
	}

	//removes uploaded files
	public function postDeletefiles(){
		$lesson = Lesson::find(Input::get('id'));
		if($lesson){
			$attach = DB::table('attachments')->where('lesson_id', '=', $lesson->id)->get();
			return View::make('admin.lesson.removefiles')
				->with('lesson_id', $lesson->id)
				->with('attaches', $attach);
		}
	}

	//remove existing files function
	public function postDestroyfiles(){
		$files = Input::get('files');
		if($files){
			for ($i=0; $i < sizeof($files); $i++) { 
				$attach = Attachment::find($files[$i]);
				if($attach){
					$attach->delete();
					$path = 'uploads/files/'.$attach->file;
					if(file_exists($path)){
						unlink($path);
					}					
				}					
		
			}

			return Redirect::to('admin/lesson/index')
						->with('message', 'Files deleted successfully');
		}
		
		return Redirect::to('admin/lesson/index')
						->with('message', 'No files selected');
		
	}
	public function allLessons() {
	// show all the lessons

		return View::make('members.lesson')
				->with('lessons', Lesson::paginate(5));

	}
}