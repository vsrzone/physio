<?php

class MemberController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	// show the page with all the members
	public function getIndex() {

		return View::make('admin.member.index')
			->with('users', User::paginate(10));
	}

	// show the member create view
	public function getCreate() {

		return View::make('admin.member.add');
	}

	// add a new user to the database
	public function postCreate() {

		$name = Input::get('name');
		$password = Hash::make(Input::get('password'));
		$type = Input::get('type');

		$user_exist = DB::table('users')->where('name', $name)->first();

		if(!$user_exist) {

			$validator = Validator::make(Input::all(), User::$rules);

			if($validator->passes()) {

				$user = new User;

				$user->name = $name;
				$user->password = $password;
				$user->type = $type;

				if($user) {

					$user->save();

					return Redirect::to('admin/user')
						->with('message', 'User Created');
				}

				return Redirect::to('admin/user')
					->with('message', 'Operation Unsuccessful');
			}

			return Redirect::to('admin/user/create')
			->with('message', 'Something went wrong')
			->withErrors($validator)
			->withInput();
		}

		return Redirect::to('admin/user')
			->with('message', 'Cannot Find the User');
	}
}