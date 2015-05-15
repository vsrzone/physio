@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif

<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>Category ID</th>
		<th>Category name</th>
		<th colspan="2">Edit/Delete</th>
	</tr>
	@foreach($exams as $exam)
		<?php 
		var_dump($exams);
		die();
		?>
		<tr>
			<td> {{ $exam->state }} </td>
			<td> {{ $exam->member_id }} </td>
			<td> {{ $exam->paper_id }} </td>
			{{Form::open(array('url'=>'admin/exam/enablestatus'))  }}
			{{ Form::hidden('id', $exam->id) }}
			<td> {{ Form::submit('Enable', array('class'=>'btn btn-info')) }} </td>
			{{ Form::close() }}
		</tr>
	@endforeach
</table>
<div> {{$categories->links()}} </div>
@stop