<?php

class ConfigurationSeeder extends DatabaseSeeder {

	public function run()
	{
		Configuration::truncate();
		$now = date("Y-m-d H:i:s");

		Configuration::create(array(
			'id' 				=> 1,
			'configure_name' 	=> 'mdbfilename',
			'created_at'		=> $now,
			'updated_at'		=> $now
		));

		Configuration::create(array(
			'id' 				=> 2,
			'configure_name' 	=> 'mdbusername',
			'created_at'		=> $now,
			'updated_at'		=> $now
		));

		Configuration::create(array(
			'id' 				=> 3,
			'configure_name' 	=> 'mdbpassword',
			'created_at'		=> $now,
			'updated_at'		=> $now
		));

		Configuration::create(array(
			'id'				=> 4,
			'configure_name'	=> 'mdbtablename',
			'created_at'		=> $now,
			'updated_at'		=> $now
		));

	}
}