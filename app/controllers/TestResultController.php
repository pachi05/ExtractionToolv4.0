<?php

class TestResultController extends BaseController {

	protected $layout = 'layouts.master';

	public function showTestResults()
	{
		//set date for the inputs
		if(Input::get('dateFrom') === NULL && Input::get('dateTo') === NULL)
		{
			$inputDate = array(date('Y-m-d'), date('Y-m-d'));
		}
		else
		{
			$inputDate = array(Input::get('dateFrom'), Input::get('dateTo'));
		}


		//get test results
		$testResults = TestResult::where('testDate', '>=', $inputDate[0])
		  	->where('testDate', '<=', $inputDate[1])
		  	->paginate(10);

		//show TestResult Page
		$this->layout->content = View::make('testResults.viewResult')
			->with('testResults', $testResults)
			->with('inputDate', $inputDate);
	}

}