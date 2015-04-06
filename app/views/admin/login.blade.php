<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Physio - Admin panel|Login</title>  	
	</head>
	@if(Session::has('message'))
		<div> {{ Session::get('message') }} </div>
	@endif
	@if($errors->has())
	<div>
	<ul>
		@foreach($errors->all() as $error)			
				<li> {{ $error }} </li>			
		@endforeach
	</ul>
	</div>
	@endif
	<h1>Physio Login</h1>
	<div> {{ Form::open(array('url'=>'admin/login')) }}	</div>
	<div> {{ Form::email('email','', array('placeholder'=>'User name')) }} </div>
	<div> {{ Form::password('password', array('placeholder'=>'Password')) }} </div>
	<div> {{ Form::submit('Login') }} </div>
	<div> {{ Form::close() }} </div>
</html>