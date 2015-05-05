<?php

class LessonController extends BaseController{
	public function __construct(){
		$this->beforeFilter('csfr', array('on'=>'post'));
	}

	//views create page
	public function getCreate(){		
		return View::make('admin.lesson.add');
	}
}