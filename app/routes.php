<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'auth'), function()
{
	Route::get('/', 'HomeController@showDashboard');

	Route::get('results', 'TestResultController@showTestResults');

	Route::get('reports', 'ReportController@showReports');

	Route::get('settings', 'SettingController@showSettings');

	Route::get('extraction', 'ExtractionController@showExtraction');

	Route::post('settings', 'SettingController@saveMDBSettings');

	Route::post('uploads', 'HomeController@showUploadFiles');

	Route::post('extraction', 'ExtractionController@doExtraction');

	Route::post('checkdatabase', 'HomeController@doCheckDatabase');

	Route::post('generate', 'ReportController@createCSVReport');

	Route::post('download', 'ReportController@downloadReport');

});

Route::group(array('before' => 'guest'), function()
{
	Route::get('login', 'HomeController@showLogin');

	Route::post('login', 'HomeController@doLogin');
});
	
Route::get('logout', 'HomeController@doLogout');
