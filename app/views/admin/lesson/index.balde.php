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
<table border="1">
	<tr>
		<th>Lesson ID</th>
		<th>Lesson topic</th>
		<th>Content</th>
		<th colspan="2">Edit/Delete</th>
	</tr>
	@foreach($lesson as $lesson)
	<tr>
		<td> {{ $lesson->id }} </td>
		<td> {{ $lesson->topic }} </td>
		<td> {{ substr(0, 1, $lesson->content) }} </td>
		{{ Form::open(array('url'=>'admin/lesson/edit')) }}

 		<td>{{ Form::submit('Edit', array('class'=>'btn btn-info')) }}</td>
		{{ Form::close() }}
		{{Form::open(array('url'=>'admin/category/destroy'))  }}
		{{ Form::hidden('id', $category->id) }}
		<td> {{ Form::submit('Delete', array('class'=>'btn btn-danger')) }} </td>
		{{ Form::close() }}
	</tr>
	@endforeach
</table>


@stop