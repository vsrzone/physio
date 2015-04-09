<?php

class WorkController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$field = Input::get('field');
		$value = Input::get('value');
		
		if($field && $value) {

			$details = DB::table('members')
					->select('id', 'name', 'profile_picture', 'concil_registration_no', 'nic', 'district', 'hospital')
					->where($field, 'LIKE', '%'.$value.'%')
					->paginate(10);
			return View::make('members.index')
	 			->with('members', $details)
	 			->with('label', 'Search Results For: '.$value);
		}

		$members = DB::table('members')
					->select('id', 'name', 'profile_picture', 'concil_registration_no', 'nic', 'district', 'hospital')
					->orderBy('name')
					->paginate(10);

	 	return View::make('members.index')
	 		->with('members', $members);
	}

	public function show($id)
	{
		$member = DB::table('members')
					->leftJoin('users', 'users.member_id', '=', 'members.id')
					->select('name', 'concil_registration_no', 'nic', 'district', 'hospital', 'tp1', 'address', 'qualifications', 'profile_picture','email','cover_picture')
					->where('members.id', '=', $id)
					->get();

		// seperating first_name and last_name

		$first_name = $last_name = '';

		if($member[0]->name) {

			$name_arr = explode(' ',$member[0]->name);

			$last_name = $name_arr[sizeof($name_arr)-1];
			if($member[0]->name === $last_name) {
				$last_name = '';
			}

			$first_name = $name_arr[0];
		}

		// seperating address
		$address_arr = array();
		if($member[0]->address) {

			$address_arr = explode(',',$member[0]->address);
		}
		
		return View::make('members.member')
	 		->with('member', $member)
	 		->with('first_name', $first_name)
	 		->with('last_name', $last_name)
	 		->with('id', $id)
	 		->with('address', $address_arr);
	}

	// individual member edit function

	public function editMember(){
		$id = Input::get('member_id');

		$member = Member::find($id);
		$user = DB::table('users')->where('member_id', $id)->first();

		// var_dump(Auth::user()->type);
		// var_dump($user->id != Auth::user()->member_id);
		// die();

		if($user->type != Auth::user()->type) {

			if($user->type <= Auth::user()->type) {

				return Redirect::to('admin/member')
					->with('message', 'Unsuccessful operation');
			}
		}

		if($member) {

			if($user) {

				return View::make('members.edit')
					->with('user', $user)
					->with('member', $member);
			}
		}

		Redirect::to('members');
	}
}
