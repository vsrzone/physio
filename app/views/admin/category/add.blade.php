@extends('admin.layouts.main')
@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif
@if($errors->has())
	<div class="alert alert-danger">
	<ul>
		@foreach($errors->all() as $error)			
				<li> {{ $error }} </li>			
		@endforeach
	</ul>
</div>
@endif
{{ Form::open(array('url'=>'admin/category/create')) }}
<div> Category name: {{ Form::text('name', '', array('class'=>'form-control')) }} </div>
<div> {{ Form::submit('Add Category', array('class'=>'btn btn-default')) }} </div>
{{ Form::close() }}

@stop