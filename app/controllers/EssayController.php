<?php

class EssayController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	//views create page
	public function getCreate(){
		return View::make('admin.paper.essay.add');
	}
}