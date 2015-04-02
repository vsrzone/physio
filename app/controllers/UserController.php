<?php

class UserController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	// show the page with all the users
	public function getIndex() {

		return View::make('admin.user.index')
			->with('users', User::paginate(10));
	}

	// show the user create view
	public function getCreate() {

		return View::make('admin.user.add');
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

	// show the user edit page
	public function postEdit() {

		$id = Input::get('id');

		$user = User::find($id);

		if($user) {

			return View::make('admin.user.edit')
				->with('user', $user);
		}

		return View::make('admin/user')
			->with('message', 'Cannot Find the User');
	}

	// update the users
	public function postUpdate() {

		$id = Input::get('id');
		$name = Input::get('name');
		$password = Input::get('password');
		$type = Input::get('type');

		$user = User::find($id);

		if($user) {

			$user->name = $name;
			if($password !== '') {

				$user->password = Hash::make($password);
			}
			$user->type = $type;

			$user->save();

			return Redirect::to('admin/user')
				->with('message', 'User Updated');
		}

		return Redirect::to('admin/user')
			->with('message', 'Cannot Find the User');
	}

	// delete a user
	public function postDestroy() {

		$id = Input::get('id');

		$user = User::find($id);

		if($user) {

			$user->delete();

			return Redirect::to('admin/user')
				->with('message', 'User Deleted');
		}

		return Redirect::to('admin/user')
			->with('message', 'Cannot Delete the User');
	}
}