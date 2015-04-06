<?php

class MemberTableSeeder extends Seeder
{

public function run()
{
    DB::table('members')->delete();
    Member::create(array(
      'name' => 'admin',
      'nic' => 'xxxxxxxxxxv',
      'concil_registration_no' => 'xxx',
      'sex' => 0,
      'district' => 'xxx',
      'tp1' => 'xxxxxxxxxx',
      'created_by' => 0
    )); 

}
}

class UserTableSeeder extends Seeder
{

public function run()
{
    
    DB::table('users')->delete();
    User::create(array(
        'email' => 'super_admin@physio.dev',
        'member_id'=> DB::table('members')->where('name', '=', 'admin')->pluck('id'),
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
