@extends('admin.layouts.main')
@section('content')
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
{{ Form::open(array('url'=>'admin/category/create')) }}
<div> Category name: {{ Form::text('name') }} </div>
<div> {{ Form::submit('Add Category') }} </div>
{{ Form::close() }}

@stop