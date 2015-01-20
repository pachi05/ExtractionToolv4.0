<?php

class UserSeeder extends DatabaseSeeder {

	public function run()
	{
		User::truncate();
		$now = date("Y-m-d H:i:s");

		User::create(array(
			'id' 			=> 1,
			'username' 		=> 'admin',
			'password' 		=> Hash::make('admin'),
			'name' 			=> 'Administrator',
			'email' 		=> 'jason@open-axcss.com',
			'created_at' 	=> $now,
			'updated_at'	=> $now
		));
	}
	
}