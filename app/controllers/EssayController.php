<?php

class EssayController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	//views create page
	public function getCreate(){
		$examiners = DB::table('members')
						->leftJoin('users', 'users.member_id', '=', 'members.id')
						->where('type', '=', 1)
						->select('members.id as member_id', 'users.id as user_id', 'members.name', 'email')						
				        ->get();
		return View::make('admin.paper.essay.add')
				->with('examiners', $examiners);
	}
}