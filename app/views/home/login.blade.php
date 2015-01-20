@extends('layouts.master')

@section('titlebar')
Login - MLI Extraction Tool
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 login-form-div">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>Login</strong></div>
					<div class="panel-body">
						{{Form::open(array('action' => 'HomeController@doLogin'))}}
							<div class="form-group">
								<input type="text" name="username" class="form-control"  value="{{Input::old('username')}}" placeholder="Username">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div>
							@if($errors->count())
							<div class="form-group">
								<span class="error-font">{{$errors->first()}}</span>
							</div>
							@elseif(Session::has('login_error'))
							<div class="form-group">
								<span class="error-font">{{Session::get('login_error')}}</span>
							</div>
							@endif
							<input type="submit" value="Login" class="btn btn-primary btn-block">
						{{Form::close()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop