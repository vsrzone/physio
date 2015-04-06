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
{{ Form::open(array('url'=>'admin/category/update')) }}
<div> Category name: {{ Form::text('name', $category->name) }} </div>
{{ Form::hidden('id', $category->id) }}
<div> {{ Form::submit('Save Changes') }} </div>
{{ Form::close() }}

@stop