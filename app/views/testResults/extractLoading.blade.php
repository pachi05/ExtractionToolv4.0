@extends('layouts.master')

@section('titlebar')
Dashboard - MLI Extraction Tool
@stop

@section('content')
@include('layouts.header')
<div class="col-md-8 div-extraction">
	<div class="panel panel-default">
		<div class="panel-heading">
			Extract Test Results
		</div>
		<div class="panel-body">
			<div class="col-md-12">
				<div class="input-center" id="div-extract-result">
					<h1 class="font-big">{{$rowCount}}<h1>
					<h3>Test Results are ready to upload</h3>
					{{Form::open(array('action' => 'ExtractionController@doExtraction', 'id' => 'form-extract-now'))}}
						<input type="submit" value="Extract Now" class="btn btn-primary btn-lg">
					{{Form::close()}}
				</div>
				<div class="progress hide" id="div-progress-bar">
					<div class="progress-bar progress-bar-striped active" style="width:100%;"></div>
				</div>
				<div id="div-progress-text" class="col-md-12 hide" style="text-align:center;">
					<span id="span-progress-text">Extracting Test Results from MDB. Please wait for a while.</span>
				</div>
				<div class="col-md-12 input-center hide" id="div-progress-post">
					<span class="glyphicon glyphicon-ok-sign" style="color:green; font-size:100px; padding-bottom:15px;"></span>
					<h1>Extraction Complete</h1>
					<a href="{{URL::to('results')}}" class="btn btn-primary btn-lg" role="button">Go to Test Results</a>	
					<a href="{{URL::to('/')}}" class="btn btn-default btn-lg" role="button">Back To Dashboard</a>
				</div>
			</div>
		</div>
	</div>
</div>
@stop