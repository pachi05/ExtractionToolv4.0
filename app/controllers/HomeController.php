<?php

class HomeController extends BaseController {

	protected $layout = 'layouts.master';

	public function showDashboard()
	{
		//get configuration data
		$config = Configuration::all();

		//get filename only
		$splitfile = explode('\\', $config[0]->configure_value); //mdb filename
		$mdbfilename = end($splitfile);

		//get UpdateHistory
		$histories = UpdateHistory::all();

		//get GeneratedResult
		$results = GeneratedResult::all();

		try
		{
			//validate access connection
			$mdbFilename = realpath($config[0]->configure_value); //mdb filename
			$conn = odbc_connect(
				"Driver={Microsoft Access Driver (*.mdb)};Dbq=$mdbFilename", 
				$config[1]->configure_value, //mdb username
				$config[2]->configure_value  //mdb password
			);
			$checkQuery = 'SELECT * FROM '.$config[3]->configure_value; //mdb tablename 
			$checkTable = odbc_exec($conn, $checkQuery); //check table
			odbc_close($conn);
			
		}
		catch(Exception $e)
		{
			$checkTable = false;
		}
		
		//get connection status
		$connStatus = (!$checkTable) ? false : true;

		//get latest extraction date of mdb
		$lastMDBUpdates = UpdateHistory::where('tag','mdb')
			->orderBy('updated_at', 'desc')
			->first();

		//show dashboard page
		$this->layout->content =  View::make('home.dashboard')
			->with('mdbfilename', $mdbfilename.' => '. $config[3]->configure_value) //set table
			->with('connStatus', $connStatus)
			->with('lastMDBUpdates', $lastMDBUpdates)
			->with('histories', $histories)
			->with('results', $results);
	}

	public function doCheckDatabase()
	{
		//get Configuration data
		$config = Configuration::all();

		//Validate Token
		if (Session::token() !== Input::get('_token'))
		{
			return Response::json(array(
				'status' => 'error',
				'msg' => 'Unauthorized Access.'
			));
		}

		//get the latest test date of mdb
		$lastTestDate = UpdateHistory::where('tag','mdb')
			->orderBy('updated_at', 'desc')
			->first(array('lastTestDate'));

		$lastTestDate = str_replace(array('{"lastTestDate":"', '"}'), "", $lastTestDate);
		
		$lastDate = explode('-', $lastTestDate);
		var_dump($lastDate);

		for($iYear = )

	}

	public function showLogin()
	{
		$this->layout->content = View::make('home.login');
	}

	public function doLogin()
	{
		$rules = array(
			'username' => 'sometimes|required',
			'password' => 'sometimes|required'
		);

		$message = array('required'	=> 'Please login.');

		$validator = Validator::make(Input::all(), $rules, $message);
		if($validator->passes())
		{
			$userdata = array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
			);
			
			if(Auth::attempt($userdata))
			{
				return Redirect::to('/');
			}
			else
			{
				return  Redirect::to('login')
					->with('login_error', 'Invalid username/password. Please try again.')
					->withInput(Input::except('password'));
			}
		}
		else
		{
			return Redirect::to('login')
				->withErrors($validator)
				->withInput(Input::except('password'));
		}

	}

	public function doLogout()
	{
		Auth::logout();
		return Redirect::to('login');
	}

}