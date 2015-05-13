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
		<th>Paper Id</th>
		<th>Paper Title</th>
		<th colspan="2">Edit/Delete</th>
	</tr>
	@foreach($papers as $paper)
	<tr>
		<td>$paper->id</td>
		<td>$paper->title</td>
		{{ Form::open(array('url'=>'admin/paper/edit')) }}
		{{ Form::hidden('id', $paper->id) }}
		<td> {{ Form::submit('Edit') }} </td>
		{{ Form::close() }}
		{{ Form::open(array('url'=>'admin/paper/destroy')) }}
		{{ Form::hidden('id', $paper->id) }}
		<td> {{ Form::submit('Delete') }} </td>
		{{ Form::close() }}		
	</tr>
	@endforeach
</table>
@stop