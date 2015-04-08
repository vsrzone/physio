<?php

class AuthController extends BaseController{

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('guest', array('except' => array('getLogout', 'getIndex')));
	}

	//view login page
	public function getLogin(){
		return View::make('admin/login');
	}

	//login function
	public function postLogin(){
		$validator = Validator::make(
			 array('email' => Input::get('email'),
		    'password' => Input::get('password')),

		    array('email' => 'required',
		    'password' => 'required')
		);

		if($validator->passes()){
			if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password') )))
			{	

				if(Auth::user()->type == 3){
					return Redirect::to('/');
				}			
			    return View::make('admin.layouts.main');
			}

			return Redirect::to('admin/login')
				->with('message', 'Illegal credentials. Please try again');
		}

		return Redirect::to('admin/login')
			->with('message', 'Following errors occured')
			->withErrors($validator);
	}

	//logout function
	public function getLogout(){
		
		if(Auth::check()){
			Auth::logout();
		}

		return Redirect::to('/');
	}

	public function getIndex(){
		return Redirect::to('admin/login');
	}
}