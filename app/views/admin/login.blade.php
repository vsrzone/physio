<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="{{URL::to('/')}}/resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{URL::to('/')}}/resources/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL::to('/')}}/resources/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{URL::to('/')}}/resources/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	
	<title>Physio - Admin panel|Login</title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-success" style="top: 80px;position: relative;">
				<div class="panel-heading">Sign In</div>
				<div class="panel-body">
					@if(Session::has('message'))
					<div class="alert alert-danger">	
						{{ Session::get('message') }}
						@if($errors->has())	
						<ul>
							@foreach($errors->all() as $error)			
									<li> {{ $error }} </li>			
							@endforeach
						</ul>
						@endif	
					</div>
					@endif						
					{{ Form::open(array('url'=>'admin/login')) }}
					<div style="padding:3px">{{ Form::email('email','', array('placeholder'=>'User name', 'class'=>'form-control')) }}</div>
					<div style="padding:3px"> {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control')) }}</div>
					{{Form::checkbox('remember')}} Remember Me
					<div style="padding:3px">{{ Form::submit('Login', array('class'=>'btn btn-success btn-lg btn-block')) }} </div>

					{{ Form::close() }}	
				</div>
				<div class="panel-footer">
			<a href="{{url()}}">Back to HOME</a>	
		</div>					
			</div>				
		</div>		
	</div>
			
</div>

</body>
</html>