<?php

class SettingController extends BaseController {

	protected $layout = 'layouts.master';

	public function showSettings()
	{
		//get configuration data
		$config = Configuration::all();
		
		//show setting page
		$this->layout->content = View::make('settings.setting')
			->with('config', $config);
	}

	public function saveMDBSettings()
	{
		//validate access connection
		$mdbFilename = realpath(Input::get('mdbfilename'));
		$conn = odbc_connect("Driver={Microsoft Access Driver (*.mdb)};Dbq=$mdbFilename", Input::get('mdbusername'), Input::get('mdbpassword'));	
		$checkQuery = 'SELECT * FROM '.Input::get('mdbtablename');
		$checkTable = odbc_exec($conn, $checkQuery);
		if(!$checkTable)
		{
			//return failed to settings
			return Redirect::to('settings')
				->with('setting_status', false)
				->withInput(Input::except('mdbpassword'));
		}
		else
		{	
			//initialize data for updating configuration
			$user = Auth::user()->name;
			$now = date('Y-m-d H:i:s');

			//set filename to config db
			$mdbConf = Configuration::find(1);
			$mdbConf->configure_value = Input::get('mdbfilename');
			$mdbConf->configure_by = $user;
			$mdbConf->updated_at = $now;
			$mdbConf->save();

			//set username to config db
			$mdbConf = Configuration::find(2);
			$mdbConf->configure_value = Input::get('mdbusername');
			$mdbConf->configure_by = $user;
			$mdbConf->updated_at = $now;
			$mdbConf->save();

			//set password to config db
			$mdbConf = Configuration::find(3);
			$mdbConf->configure_value = Input::get('mdbpassword');
			$mdbConf->configure_by = $user;
			$mdbConf->updated_at = $now;
			$mdbConf->save();

			//set tablename to config db
			$mdbConf = Configuration::find(4);
			$mdbConf->configure_value = Input::get('mdbtablename');
			$mdbConf->configure_by = $user;
			$mdbConf->updated_at = $now;
			$mdbConf->save();

			//get configuration data
			$config = Configuration::all();

			//return success to settings
			return Redirect::to('settings')
				->with('setting_status', true)
				->with('config', $config);
		}
	}
	
}