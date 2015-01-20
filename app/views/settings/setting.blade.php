@extends('layouts.master')

@section('titlebar')
Settings - MLI Extraction Tool
@stop

@section('content')
@include('layouts.header')
<div class="navbar"></div>
<div class="container-fluid">
	@if(Session::has('setting_status'))
		<div class="row">
			<div class="col-md-12">
			@if(Session::get('setting_status'))
			<div class="alert alert-success" role="alert">
				<span class="glyphicon glyphicon-ok"></span>
				<span>MDB Setting Saved.</span>
			</div>
			@else
			<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span>Unable to connect MDB.</span>
			</div>
			@endif
			</div>
		</div>
	@endif
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="navbar"><h3>Settings</h3></div>
			<div class="panel panel-default">
				<div class="panel-heading">MDB Settings</div>
				<div class="panel-body">
					<div class="alert alert-info" role="alert">
						<span class></span>
						<span>Note: Once you've set the mdb connection. You can no longer change the settings.</span>
					</div> 
					{{Form::open(array('action' => 'SettingController@saveMDBSettings'))}}
						<div class="row">
							<div class="col-md-3">
								<p class="navbar-form input-label">MS Access Database File:</p>
							</div>
							<div class="col-md-6">
							@if($config[0]->configure_value == null)
								<input type="text" class="form-control" name="mdbfilename" value="{{Input::old('mdbfilename')}}" placeholder="e.g. C:/Path/Filename.mdb" id="mdb-input-filepath">
							@else
								<span class="form-control">{{$config[0]->configure_value}}</span>
							@endif
							</div>	
						</div>
						<div class="row">
							<div class="col-md-3">
								<p class="navbar-form input-label">Database Username:</p>
							</div>
							<div class="col-md-6">
							@if($config[0]->configure_value == null)
								<input type="text" class="form-control" name="mdbusername" value="{{Input::old('mdbusername')}}" placeholder="e.g. root" id="mdb-input-dbusername">
							@else
								<span class="form-control">{{$config[1]->configure_value}}</span>
							@endif
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<p class="navbar-form input-label">Database Password:</p>
							</div>
							<div class="col-md-6">
							@if($config[0]->configure_value == null)
								<input type="text" class="form-control" name="mdbpassword" value="" id="mdb-input-dbpassword">
							@else
								<span class="form-control">********</span>
							@endif
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<p class="navbar-form input-label">Database Table:</p>
							</div>
							<div class="col-md-6">
							@if($config[0]->configure_value == null)
								<input type="text" class="form-control" name="mdbtablename" value="{{($config[3]->configure_value == null) ? Input::old('mdbtablename') : $config[3]->configure_value}}" id="mdb-input-dbtablename" placeholder="e.g. test_table">
							@else
								<span class="form-control">{{$config[3]->configure_value}}</span>
							@endif
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="navbar-form">
									<input type="submit" value="Save Changes" class="btn btn-disabled navbar-right" id="mdb-input-submit" disabled="disabled">
								</div>
							</div>
						</div>
					{{Form::close()}}
				</div>
			</div>			
		</div>	
	</div>
</div>
@stop