<?php

class ReportController extends BaseController {

	protected $layout = 'layouts.master';

	public function showReports()
	{
		//get reports
		$reports = GeneratedResult::paginate(10);

		//show generated report page
		$this->layout->content = View::make('reports.report')
			->with('reports', $reports);
	}

	public function createCSVReport()
	{
		//initialize CSV Metadata		
		$CSVFileName = 'TestReport '.str_replace('-', '', Input::get('dateFrom'))."".str_replace('-', '', Input::get('dateTo'))."".date('YmdHis');	

		//get test results
		Excel::create($CSVFileName, function($excel) {
			//set CSV properties
			$excel->setTitle('TestReport '.str_replace('-', '', Input::get('dateFrom'))."".str_replace('-', '', Input::get('dateTo'))."".date('YmdHis'))
				->setCreator(Auth::user()->name)
				->setCompany('TMC')
				->setLastModifiedBy(Auth::user()->name);

			//set Spreadsheet properties
			$excel->sheet('TestResult', function($sheet) {
				$sheet->setAutoSize(true);
				$sheet->setOrientation('landscape')
					->fromModel(TestResult::where('testDate', '>=', Input::get('dateFrom'))
						->where('testDate', '<=', Input::get('dateTo'))
						->get(array('id', 'meterNo', 'model', 'current', 'constant', 'temperature', 'humidity', 'testDate', 'conclusion24h', 'conclusion'))					
				);
			});
		})->store('csv');

		//save generated report properties
		$results = new GeneratedResult();
		$results->filename = 'TestReport '.str_replace('-', '', Input::get('dateFrom'))."".str_replace('-', '', Input::get('dateTo'))."".date('YmdHis').'.csv';
		$results->created_by = Auth::user()->name;
		$results->created_at = date('Y-m-d H:i:s');
		$results->download = 0;
		$results->save();

		//return to reports page
		return Redirect::to('reports');
	}

	public function downloadReport()
	{
		try
		{
			 $downloadResult = GeneratedResult::where('filename', Input::get('filename'))
			 	->get(array('id'));	 

			$downloadProperty = GeneratedResult::find($downloadResult[0]->id);
			$downloadProperty->download += 1;
			$downloadProperty->save();

			return Response::download(storage_path()."\\exports\\".Input::get('filename'));
		}

		catch(Exception $e)
		{
			GeneratedResult::where('filename', Input::get('filename'))
				->delete();

			return Redirect::to('reports');	
		}
		
	}
}