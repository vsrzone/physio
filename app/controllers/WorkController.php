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
					->select('name', 'profile_picture', 'concil_registration_no', 'nic', 'district', 'hospital')
					->where($field, '=', $value)
					->get();
			return Response::json($details);
		}

		$members = DB::table('members')
					->select('name', 'profile_picture', 'concil_registration_no', 'nic', 'district', 'hospital')
					->orderBy('name')
					->get();

	 	return View::make('members.index')
	 		->with('members', $members);
	}

	public function show($id)
	{
		$member = DB::table('members')
					->select('name', 'profile_picture', 'concil_registration_no', 'nic', 'district', 'hospital')
					->where('id', '=', $id)
					->get();
		return Response::json($member);
		// return View::make('members.single')
	 // 		->with('members', $member);
	}

	// public function search($field, $value) {

	// 	$details = DB::table('members')
	// 				->select('name', 'profile_picture', 'concil_registration_no', 'nic', 'district', 'hospital')
	// 				->where($field, '=', $value)
	// 				->get();
	// 	return Response::json($details);
	// }

	// public function test($field) {
	// 	var_dump($field);
	// 	die();

	// 	// $details = DB::table('members')
	// 	// 			->select('name', 'profile_picture', 'concil_registration_no', 'nic', 'district', 'hospital')
	// 	// 			->where($field, '=', $value)
	// 	// 			->get();
	// 	// return Response::json($details);
	// }
}
