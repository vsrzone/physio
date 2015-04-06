<?php

class MemberController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('super_admin');
	}

	// show the page with all the members
	public function getIndex() {

		$member = DB::table('members')
			->leftJoin('users', 'users.member_id', '=', 'members.id')
			->select('members.id','members.name', 'type','sex', 'nic', 'concil_registration_no', 'district')						
	        ->paginate(10);

		return View::make('admin.member.index')
			->with('members', $member);
	}

	// show the member create view
	public function getCreate() {

		return View::make('admin.member.add');
	}

	// add a new user to the database
	public function postCreate() {

		// getting all the inputs to variables
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

		// uploading profile picture
		if($pro_pic) {

			$profile_pic_name = time().'.jpeg';
			$im = imagecreatefromjpeg($pro_pic);
			imagejpeg($im, 'uploads/member/profile/'.$profile_pic_name, 70);
			imagedestroy($im);
		} else {

			// setting the default profile picture if members didn't upload any image
			if($sex == 0) {
				$profile_pic_name = 'default_male.jpeg';
			} else if($sex == 1) {
				$profile_pic_name = 'default_female.jpeg';
			}
		}

		// uploading cover photo
		$cover_pic = Input::get('cover_pic');

		if($cover_pic) {

			$cover_pic_name = time().'.jpeg';
			$im = imagecreatefromjpeg($cover_pic);
			imagejpeg($im, 'uploads/member/cover/'.$cover_pic_name, 70);
			imagedestroy($im);
		} else {

			// setting the default cover picture if members didn't upload any image
			$cover_pic_name = 'default_cover.jpeg';
		}
		
		$description = Input::get('description');
		$qualifications = Input::get('qualifications');
		$experience = Input::get('experience');

		$user_exist = DB::table('users')->where('email', $name)
										->get();
		// checking the user existence
		if(!$user_exist) {

			// validating member table inputs
			$validator_member = Validator::make(array('nic' => Input::get('nic'), 'name' => Input::get('name'), 'concil_registration_no' => Input::get('council_reg_no'), 'sex' => Input::get('sex'), 'district' => Input::get('district'), 'tp1' => Input::get('tp1')), Member::$rules);

			if($validator_member->passes()) {

				// validating user table inputs
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
					$member->profile_picture = $profile_pic_name;
					$member->cover_picture = $cover_pic_name;
					$member->description = $description;
					$member->qualifications = $qualifications;
					$member->experience = $experience;
					$member->created_by = 1;// need to get the looged in user's id at the momemt of creating
					$member->updated_by = 1;// need to get the logged in user's id at the moment of updating


					if($member) {

						// creating a member
						$member->save();

						$member_id = DB::table('members')->where('name', $name)->pluck('id');

						$user = new User;

						$user->email = $email;
						$user->password = $password;
						$user->type = $type;
						$user->member_id = $member_id;

						if($user) {

							// creating a user
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
			->withErrors($validator_member)
			->withInput();
		}

		return Redirect::to('admin/user')
			->with('message', 'Member Already Exists');
	}

// show the member edit page
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

		return View::make('admin/user')
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
				$member->created_by = 1;// need to get the looged in user's id at the momemt of creating
				$member->updated_by = 1;// need to get the logged in user's id at the moment of updating

				$member->save();

				// updating user table

				$user->type = $type;
				$user->email = $email;
				$user->member_id = $id;

				$user->save();

				return Redirect::to('admin/member')
					->with('message', 'User Updated');
			}
		}

		return Redirect::to('admin/member')
			->with('message', 'Cannot Find the User');
	}

	// delete a member
	public function postDestroy() {

		$id = Input::get('id');

		$member = Member::find($id);
		$pro_pic = $member->profile_picture;
		$cover_pic = $member->cover_picture;
		$user_id = DB::table('users')->where('member_id', $id)->first();
		$user = User::find($user_id->id);


		if($user) {

			// delete the entry from the users table
			$user->delete();

			if($member) {

				// delete the entry from the members table
				$member->delete();

				$profile_target = "uploads/member/profile/".$pro_pic;
			
				if(file_exists($profile_target)){
					unlink($profile_target);
				}

				$cover_target = "uploads/member/cover/".$cover_pic;
			
				if(file_exists($cover_target)){
					unlink($cover_target);
				}

				return Redirect::to('admin/member')
					->with('message', 'Member Deleted');
			}
		}

		return Redirect::to('admin/member')
			->with('message', 'Cannot Delete the User');
	}
}