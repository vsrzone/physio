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
{{ Form::open(array('url'=>'admin/category/update')) }}
<div> Category name: {{ Form::text('name', $category->name, array('class'=>'form-control')) }} </div>
{{ Form::hidden('id', $category->id) }}
<div> {{ Form::submit('Save Changes', array('class'=>'btn btn-default')) }} </div>
{{ Form::close() }}

@stop