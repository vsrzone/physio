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
<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>Lesson ID</th>
		<th>Lesson topic</th>
		<th>Content</th>
		<th colspan="2">Edit/Delete</th>
	</tr>
	@foreach($lessons as $lesson)
	<tr>
		<td> {{ $lesson->id }} </td>
		<td> {{ $lesson->topic }} </td>
		<td> {{ substr($lesson->content, 0, 20) }}... </td>
		{{ Form::open(array('url'=>'admin/lesson/edit')) }}
		{{ Form::hidden('id', $lesson->id) }}
 		<td>{{ Form::submit('Edit', array('class'=>'btn btn-info')) }}</td>
		{{ Form::close() }}
		{{Form::open(array('url'=>'admin/lesson/destroy'))  }}
		{{ Form::hidden('id', $lesson->id) }}
		<td> {{ Form::submit('Delete', array('class'=>'btn btn-danger')) }} </td>
		{{ Form::close() }}
	</tr>
	@endforeach
</table>


@stop