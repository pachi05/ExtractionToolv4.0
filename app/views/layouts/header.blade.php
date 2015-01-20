<!--HEADER-->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="nav-container">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>	
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Brand</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				@if(Request::path() == "/")
				<li class="active"><a href="{{URL::action('HomeController@showDashboard')}}">Dashboard</a></li>
				@else
				<li><a href="{{URL::action('HomeController@showDashboard')}}">Dashboard</a></li>
				@endif
				@if(Request::path() == "results")
				<li class="active"><a href="{{URL::action('TestResultController@showTestResults')}}">Test Results</a></li>
				@else
				<li><a href="{{URL::action('TestResultController@showTestResults')}}">Test Results</a></li>
				@endif
				@if(Request::path() == "reports")
				<li class="active"><a href="{{URL::action('ReportController@showReports')}}">Reports</a></li>
				@else
				<li><a href="{{URL::action('ReportController@showReports')}}">Reports</a></li>
				@endif

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, {{Auth::user()->name}} <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{URL::action('HomeController@doLogout')}}">Logout</a></li>
						<li class="divider"></li>
						<li><a href="{{URL::action('SettingController@showSettings')}}">Settings</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<!--HEADER-END-->