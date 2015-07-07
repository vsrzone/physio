@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif
<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>Exam ID</th>
		<th>Paper ID</th>
		<th>Member ID</th>
		<th>Marks</th>
		<th>Strart - End</th>
	</tr>
	@foreach($results as $result)
	<tr>
		<td>{{$result->id}}</td>
		<td>{{$result->paper_id}}</td>
		<td>{{$result->member_id}}</td>
		<td>{{$result->marks}}</td>
		<td>{{$result->start_time}} - {{$result->end_time}}</td>
	</tr>
	@endforeach
</table>
<div>
	{{$results->links()}}
</div>
@stop