@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif

<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>Paper</th>
		<th>Member</th>
		<th>Examination Status</th>
		<th>Star Time</th>
		<th>End Time</th>
		<th></th>
	</tr>
	@foreach($essays as $essay)
		<tr>
			<td> {{ $essay->paper_id }} </td>
			<td> {{ $essay->name.' [ '.$essay->member_id.' ]' }} </td>
			<td> {{ $essay->state }}</td>
			<td> {{ $essay->start_time }}</td>
			<td> {{ $essay->end_time }}</td>
			{{Form::open(array('url'=>'admin/paper/essay/marking'))  }}
			{{ Form::hidden('id', $essay->id) }}
			@if()
				<td> {{ Form::submit('View Answers', array('class'=>'btn btn-info')) }} </td>
			@endif
			{{ Form::close() }}
		</tr>
	@endforeach
</table>
<div> {{$essays->links()}} </div>
@stop