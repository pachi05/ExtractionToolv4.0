@extends('layouts.master')

@section('titlebar')
Dashboard - MLI Extraction Tool
@stop

@section('content')
@include('layouts.header')
<div class="navbar"></div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">Access Database Connection</div>
				<div class="panel-body">
				@if(!$connStatus)	
					Looks like you haven't setup the mdb source.
					<a href="{{URL::action('SettingController@showSettings')}}">Setup Here</a>
				@else
				<div class="container-fluid">
					<table class="table table-striped table-details">
						<tr>
							<td class="table-title">MDB Source:</td>
							<td><strong>{{$mdbfilename}}</strong></td>
						</tr>
						<tr>
							<td class="table-title">MDB Status:</td>
							@if($connStatus)
								<td style="color:green"><strong>Connected</strong></td>
							@else
								<td style="color:red"><strong>Unable to connect from source.</strong></td>
							@endif
						</tr>
						<tr>
							<td class="table-title">Latest Extraction:</td>
							<td>{{(!($lastMDBUpdates["updated_at"])) ? 'No Extraction yet':$lastMDBUpdates["updated_at"]}}</td>
						</tr>
					</table>
					<div class="form-group">
						@if(!($lastMDBUpdates["updated_at"]))
							<a href="{{URL::action('ExtractionController@showExtraction')}}" class="btn btn-primary" role="button">Extract Test Results</a> 
						@else
							{{Form::open(array('action' => 'HomeController@doCheckDatabase', 'id' => 'form-check-database'))}}
								<input type="submit" id="btn-check-database" class="btn btn-default" value="Check Database">
							{{Form::close()}}
						@endif
						<span id="span-wait-load" hidden="hidden"><img src="{{URL::asset('gif/wait-loader.gif')}}" style="width:25px; margin-left:30%;"> Checking Database.</span>
					</div>
				</div>
				@endif
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">Upload History</div>
				<div class="panel-body">
					@if($histories->count())
					<table class="table table-striped table-view">
						<thead>
							<td><strong>Extraction Date</strong></td>
							<td><strong>Updated By</strong></td>
							<td><strong>Last Test Date</strong></td>
							<td><strong>Tag</strong></td>
						</thead>
						@foreach($histories as $key => $value)
						<tr>
							<td>{{$value->created_at}}</td>
							<td>{{$value->updated_by}}</td>
							<td>{{$value->lastTestDate}}</td>
							<td>{{$value->tag}}</td>
						</tr>
						@endforeach
					</table>
					@else
					No Updates Yet.
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">Upload Excel File</div>
				<div class="panel-body">
					<div class="container-fluid">
						<div class="row">	
							{{Form::open(array('action' => 'HomeController@showUploadFiles'))}}
							<div class="col-md-9">
								<input type="file" name="mdbPath" class="form-control" accept="application/vnd.ms-excel">
							</div>
							<div class="col-md-3">
								<input type="submit" value="Upload File" class="btn btn-primary">
							</div>
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">Generated Reports</div>
				<div class="panel-body">
					@if($results->count())
					<table class="table table-striped table-view">
						<thead>
							<td><strong>Filename</strong></td>
							<td><strong>Date Created</strong></td>
						</thead>
						@foreach($results as $key => $value)
						<tr>
							<td>{{$value->filename}}</td>
							<td>{{$value->updated_at}}</td>
						</tr>
						@endforeach
					</table>
					<div class="navbar-form">
						<a href="{{URL::to('reports')}}" class="navbar-right">More Details</a>
					</div>
					@else
					No Updates Yet.
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@stop