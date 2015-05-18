@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif

<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>State ID</th>
		<th>Member ID</th>
		<th>Paper ID</th>
		<th colspan="2">Edit/Delete</th>
	</tr>
	@foreach($exams as $exam)
		<tr>
			<td> {{ $exam->state }} </td>
			<td> {{ $exam->member_id }} </td>
			<td> {{ $exam->paper_id }} </td>
			{{Form::open(array('url'=>'admin/exam/postenablestatus'))  }}
			{{ Form::hidden('id', $exam->id) }}
			<td> {{ Form::submit('Accept', array('class'=>'btn btn-info')) }} </td>
			{{ Form::close() }}
		</tr>
	@endforeach
</table>
<div> {{$exams->links()}} </div>
@stop