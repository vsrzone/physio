<?php

class MemberTableSeeder extends Seeder
{

public function run()
{
    // DB::table('members')->delete();
    Member::create(array(
      'name' => 'John Doe',
      'nic' => '123456789v',
      'concil_registration_no' => '1234',
      'sex' => 0,
      'district' => 'Colombo',
      'hospital' => 'Hospital',
      'Address' => '123, Colombo 7',
      'tp1' => '0777777777',
      'tp2' => '0777777778',
      'tp3' => '0777777779',
      'profile_picture' => 'default_male.jpeg',
      'cover_picture' => 'default_cover.jpeg',
      'description' => 'descriptondescriptondescriptondescriptondescriptondescriptondescriptondescriptondescripton',
      'qualifications' => 'qualifications qualifications',
      'experience' => 'experience experience experience',
      'created_by' => 0,
      'updated_by' => 0
    )); 

}
}

class UserTableSeeder extends Seeder
{

public function run()
{
    
    // DB::table('users')->delete();
    User::create(array(
        'email' => 'super_admin@physio.dev',
        'member_id'=> DB::table('members')->where('name', '=', 'John Doe')->pluck('id'),
        'type'=> 1,
        'password' => Hash::make('pass'),
    ));

}
}


class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('MemberTableSeeder');
		$this->call('UserTableSeeder');
	}

}
