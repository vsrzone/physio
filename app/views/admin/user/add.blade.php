@extends('admin.layouts.main')

@section('content')

{{ Form::open(array('url'=>'admin/user/create')) }}

{{ Form::label('Username')}}
{{ Form::text('name') }}
<br>
{{ Form::label('Password')}}
{{ Form::password('password') }}
<br>
{{ Form::label('User Type')}}
{{ Form::select('type', array('1'=>'Super Admin', '2'=>'Admin')) }}
<br>
{{ Form::submit('Submit')}}

{{ Form::close() }}

@if($errors->has())
	<div>
		<p> The following errors has occurred:</p>

		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

@stop