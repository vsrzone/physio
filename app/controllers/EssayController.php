<?php

class EssayController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	//views create page
	public function getCreate(){
		return View::make('admin.paper.essay.add');
	}

	public function postEdit() {
	// show the edit form for question edit

		$id = Input::get('id');
		$essay = Mcq::find($id);

		return View::make('admin.paper.essay.edit')
			->with('essays', $essay);
	}
}