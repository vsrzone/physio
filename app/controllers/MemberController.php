<?php

class MemberController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	// show the page with all the members
	public function getIndex() {

		return View::make('admin.member.index')
			->with('members', Member::paginate(10));
	}

	// show the member create view
	public function getCreate() {

		return View::make('admin.member.add');
	}

	// add a new user to the database
	public function postCreate() {

		$nic = Input::get('nic');
		$email = Input::get('email');
		$name = Input::get('name');
		$council_reg_no = Input::get('council_reg_no');
		$sex = Input::get('sex');
		$password = Hash::make(Input::get('password'));
		$type = Input::get('type');
		$district = Input::get('district');
		$hospital = Input::get('hospital');
		$address = Input::get('address');
		$tp1 = Input::get('tp1');
		$tp2 = Input::get('tp2');
		$tp3 = Input::get('tp3');
		$pro_pic = Input::get('pro_pic');
		$cover_pic = Input::get('cover_pic');
		$description = Input::get('description');
		$qualifications = Input::get('qualifications');
		$experience = Input::get('experience');
		$created_by = Input::get('created_by');
		$updated_by = Input::get('updated_by');

		$user_exist = DB::table('users')->where('email', $name)
										->get();

		if(!$user_exist) {

			$validator_member = Validator::make(array('nic' => Input::get('nic'), 'name' => Input::get('name'), 'concil_registration_no' => Input::get('council_reg_no'), 'sex' => Input::get('sex'), 'district' => Input::get('district'), 'tp1' => Input::get('tp1')), Member::$rules);

			if($validator_member->passes()) {

				$validator_user = Validator::make(array('email' => Input::get('email'), 'password' => Input::get('password'), 'type' => Input::get('type')),User::$rules);

				if($validator_user->passes()) {

					$member = new Member;

					$member->name = $name;
					$member->nic = $nic;
					$member->concil_registration_no = $council_reg_no;
					$member->sex = $sex;
					$member->district = $district;
					$member->hospital = $hospital;
					$member->address = $address;
					$member->tp1 = $tp1;
					$member->tp2 = $tp2;
					$member->tp3 = $tp3;
					$member->profile_picture = $pro_pic;
					$member->cover_picture = $cover_pic;
					$member->description = $description;
					$member->qualifications = $qualifications;
					$member->experience = $experience;
					$member->created_by = 1;
					$member->updated_by = 1;


					if($member) {

						var_dump($member);
						die();

						$member->save();

						$member_id = DB::table('members')->where('name', $name)->pluck('id');

						$user = new User;

						$user->email = $email;
						$user->password = $password;
						$user->type = $type;
						$user->member_id = $member_id;

						if($user) {

							$user->save();

							return Redirect::to('admin/member')
								->with('message', 'Member Created');
						}
						
						
					}

					return Redirect::to('admin/member')
						->with('message', 'Operation Unsuccessful');
				}
			}

			return Redirect::to('admin/member/create')
			->with('message', 'Something went wrong')
			->withErrors($validator_user)
			->withInput();
		}

		return Redirect::to('admin/user')
			->with('message', 'Member Already Exists');
	}
}