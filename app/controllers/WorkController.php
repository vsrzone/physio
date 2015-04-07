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
					->get();
			return View::make('members.index')
	 			->with('members', $details);
		}

		$members = DB::table('members')
					->select('id', 'name', 'profile_picture', 'concil_registration_no', 'nic', 'district', 'hospital')
					->orderBy('name')
					->get();

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
	 		->with('address', $address_arr);
	}
}
