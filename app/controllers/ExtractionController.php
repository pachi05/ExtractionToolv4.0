<?php

class ExtractionController extends BaseController {

	protected $layout = 'layouts.master';

	public function showExtraction()
	{
		//get configuration data
		$config = Configuration::all();
		
		//get latest extraction date of mdb
		$lastMDBUpdates = UpdateHistory::where('tag','mdb')
			->orderBy('updated_at', 'desc')
			->first();

		if(!($lastMDBUpdates))
		{
			$rowCountQuery = 'SELECT COUNT (*) FROM '.$config[3]->configure_value; //mdb tablename
		}
		else
		{
			$rowCountQuery = 'SELECT * FROM '.$config[3]->configure_value; //mdb tablename	
		}
		//get total rows
		$mdbFilename = realpath($config[0]->configure_value); //mdb filename
		$conn = odbc_connect(
			"Driver={Microsoft Access Driver (*.mdb)};Dbq=$mdbFilename", 
			$config[1]->configure_value, //mdb username
			$config[2]->configure_value  //mdb password
		);
		$records = odbc_exec($conn, $rowCountQuery); //check table
		
		while($row = odbc_fetch_array($records))
		{
			$rowCount = $row["Expr1000"];
		}
		odbc_close($conn);

		//show extraction page
		$this->layout->content = View::make('testResults.extractLoading')
			->with('rowCount', $rowCount);
	}

	public function doExtraction()
	{
		//set unlimited execution time
		ini_set('max_execution_time', 0);

		//get configuration data
		$config = Configuration::all();
		
		//get latest extraction date of mdb
		$lastMDBUpdates = UpdateHistory::where('tag','mdb')
			->orderBy('updated_at', 'desc')
			->first();

		if(!($lastMDBUpdates))
		{
			$rowQuery = 'SELECT * FROM '.$config[3]->configure_value; //mdb tablename
		}
		else
		{
			
		}
		
		//get total rows
		$mdbFilename = realpath($config[0]->configure_value); //mdb filename
		$conn = odbc_connect(
			"Driver={Microsoft Access Driver (*.mdb)};Dbq=$mdbFilename", 
			$config[1]->configure_value, //mdb username
			$config[2]->configure_value  //mdb password
		);
		$records = odbc_exec($conn, $rowQuery); //check table

		//get date now
		$now = date('Y-m-d H:i:s');

		while($row = odbc_fetch_array($records))
		{
			$testResult = new TestResult();
			$testResult->meterNo = $row['MeterNo'];
			$testResult->model = $row['Model'];
			$testResult->current = $row['Current'];
			$testResult->constant = $row['Constant'];
			$testResult->temperature = $row['TEMP'];
			$testResult->humidity = $row['HUMIDITY'];
			$testResult->testDate = date('Y-m-d', strtotime($row['TESTDATE']));
			$testResult->conclusion24h = $row['Conclusion24h'];
			$testResult->conclusion = $row['Conclusion'];
			$testResult->updated_at = $now;
			$testResult->tag = 'MDB';
			$testResult->save();
		}
		odbc_close($conn);

		//get last date from testResult table
		$lastTestUpdates = TestResult::where('tag', 'MDB')
			->orderBy('testDate', 'desc')
			->first();

		//update UpdateHistory Table
		$updateHistory = new UpdateHistory();
		$updateHistory->lastTestDate = $lastTestUpdates->testDate;
		$updateHistory->tag = 'MDB';
		$updateHistory->updated_by = Auth::user()->name;
		$updateHistory->updated_at = $now; 
	 	$updateHistory->save();

		return Response::json(array(
			'status' => 'success'
		));

	}

}

