@extends('layouts.master')

@section('titlebar')
View Results - MLI Extraction Tool
@stop

@section('content')
@include('layouts.header')
<div class="navbar"></div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="navbar-form navbar-right">
				{{Form::open(array('method' => 'GET', 'action' => 'TestResultController@showTestResults'))}}
				<div class="form-group">
					<input type="date" name="dateFrom" class="form-control" value="{{$inputDate[0]}}">
					<input type="date" name="dateTo" class="form-control" value="{{$inputDate[1]}}">
					<input type="submit" value="Search" class="btn btn-default">
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			@if($testResults->count())
			<table class="table table-striped table-view">
				<thead>
					<tr>
						<td><strong>MeterNo</strong></td>
						<td><strong>Model</strong></td>
						<td><strong>Current</strong></td>
						<td><strong>TEMP</strong></td>
						<td><strong>HUMIDITY</strong></td>
						<td><strong>TestDate</strong></td>
						<td><strong>Conclusion24h</strong></td>
						<td><strong>Conclusion</strong></td>
					</tr>
				</thead>
				<tbody>
					@foreach($testResults as $key => $value)	
					<tr>
						<td>{{$value->meterNo}}</td>
						<td>{{$value->model}}</td>
						<td>{{$value->current}}</td>
						<td>{{$value->temperature}}</td>
						<td>{{$value->humidity}}</td>
						<td>{{$value->testDate}}</td>
						<td>{{$value->conclusion24h}}</td>
						<td>{{$value->conclusion}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@else
			<div class="breadcrumb">
				<span class="glyphicon glyphicon-exclamation-sign"></span>
				No result found.
			</div>
			@endif
		</div>
	</div>
</div>
<div class="navbar"></div>
@if($testResults->count())
<div class="navbar navbar-default navbar-fixed-bottom">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li>	
				<div class="navbar-form navbar-left">{{$testResults->appends(Input::except('page'))->links()}}</div>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right"></ul>
		{{Form::open(array('action' => 'ReportController@createCSVReport', 'class' => 'navbar-form navbar-right'))}}
		<input type="hidden" name="dateFrom" value="{{$inputDate[0]}}">
		<input type="hidden" name="dateTo" value="{{$inputDate[1]}}">
		{{Form::submit('Generate Report', array('class' => 'btn btn-primary'))}}
		{{Form::close()}}
	</div><!-- /.navbar-collapse -->
</div>
@endif
@stop