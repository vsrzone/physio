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
		<th>Add files</th>
		<th>Remove files</th>
		<th colspan="2">Edit/Delete</th>
	</tr>
	@foreach($lessons as $lesson)
	<tr>
		<td> {{ $lesson->id }} </td>
		<td> {{ $lesson->topic }} </td>
		{{ Form::open(array('url'=>'admin/lesson/addfiles')) }}
		{{ Form::hidden('id', $lesson->id) }}
 		<td>{{ Form::submit('Add files', array('class'=>'btn btn-success')) }}</td>
		{{ Form::close() }}
		{{ Form::open(array('url'=>'admin/lesson/deletefiles')) }}
		{{ Form::hidden('id', $lesson->id) }}
 		<td>{{ Form::submit('Remove files', array('class'=>'btn btn-warning')) }}</td>
		{{ Form::close() }}		
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