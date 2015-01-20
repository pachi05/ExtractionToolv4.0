@extends('layouts.master')

@section('titlebar')
Reports - MLI Extraction Tool
@stop

@section('content')
@include('layouts.header')
<div class="navbar"></div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			@if($reports->count())
			<table class="table table-striped table-download">
				<thead>
					<tr>
						<td><strong>Filename</strong></td>
						<td><strong>Created By</strong></td>
						<td><strong>Date Created</strong></td>
						<td><strong>Downloads</strong></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
				@foreach($reports as $key => $value)
				<tr>
					<td>{{$value->filename}}</td>
					<td>{{$value->created_by}}</td>
					<td>{{$value->created_at}}</td>
					<td>{{$value->download}}</td>
					<td>
					{{Form::open(array('action' => 'ReportController@downloadReport', 'style' => 'margin-bottom:0px;', 'id' => 'form-download'))}}
						<input type="hidden" name="filename" value="{{$value->filename}}">
						<input type="submit" value="Download" class="btn btn-primary btn-xs">
					{{Form::close()}}
					</td>
				</tr>
				@endforeach	
				</tbody>
			</table>
			@else
			<div class="breadcrumb">
				<span class="glyphicon glyphicon-exclamation-sign"></span>
				No reports created.
			</div>
			@endif
			<div class="navbar-form navbar-left">{{$reports->appends(Input::except('page'))->links()}}</div>
		</div>
	</div>
</div>
@stop