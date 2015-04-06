<?php

class UserController extends BaseController{
	public function __construct() {
		//$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('member');
	}

	public function postEdit() {

		$id = Input::get('id');

		$member = Member::find($id);
		$user = DB::table('users')->where('member_id', $id)->first();

		if($member) {

			if($user) {

				return View::make('admin.member.edit')
					->with('user', $user)
					->with('member', $member);
			}
		}

		Redirect::to('admin/member')
			->with('message', 'Cannot Find the User');
	}

	public function postUpdate() {

		$id = Input::get('id');
		$nic = Input::get('nic');
		$email = Input::get('email');
		$name = Input::get('name');
		$password = Input::get('password');
		$council_reg_no = Input::get('council_reg_no');
		$sex = Input::get('sex');
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

		$user_id = DB::table('users')->where('member_id', $id)->first();
		$user = User::find($user_id->id);
		$member = Member::find($id);

		$validator_member = Validator::make(array('nic' => Input::get('nic'), 'name' => Input::get('name'), 'concil_registration_no' => Input::get('council_reg_no'), 'sex' => Input::get('sex'), 'district' => Input::get('district'), 'tp1' => Input::get('tp1'), 'created_by' => Auth::user()->member_id), Member::$rules);

		if($validator_member->passes()) {

			// validating user table inputs
			$validator_user = Validator::make(array('email' => Input::get('email'), 'type' => Input::get('type')),User::$editRules);

			if($validator_user->passes()) {

				if($member) {

					if($user) {

						if($password !== '') {

							$user->password = Hash::make($password);
						}

						if($pro_pic !== '') {

							$target = "uploads/member/profile/".$member->profile_picture;
					
							if(file_exists($target)){
								unlink($target);
							}

							$profile_pic_name = time().'.jpeg';
							$im = imagecreatefromjpeg($pro_pic);
							imagejpeg($im, 'uploads/member/profile/'.$profile_pic_name, 70);
							imagedestroy($im);

							$member->profile_picture = $profile_pic_name;
						}


						if($cover_pic !== '') {

							$target = "uploads/member/cover/".$member->cover_picture;
					
							if(file_exists($target)){
								unlink($target);
							}

							$cover_pic_name = time().'.jpeg';
							$im = imagecreatefromjpeg($cover_pic);
							imagejpeg($im, 'uploads/member/cover/'.$cover_pic_name, 70);
							imagedestroy($im);

							$member->cover_picture = $cover_pic_name;
						}

						// updating member table
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
						$member->description = $description;
						$member->qualifications = $qualifications;
						$member->experience = $experience;
						$member->updated_by = Auth::user()->member_id;// need to get the logged in user's id at the moment of updating

						$member->save();

						// updating user table

						$user->type = $type;
						$user->email = $email;
						$user->member_id = $id;

						$user->save();

						return Redirect::to('admin/member')
							->with('message', 'Member Updated');
					}
				}
			}

		}

		return Redirect::to('admin/member/create')
			->with('message', 'Something went wrong')
			->withErrors($validator_member)
			->withInput();
	}
}