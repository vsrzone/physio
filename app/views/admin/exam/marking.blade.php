@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif

<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>Member ID</th>
		<th>Paper ID</th>
		<th>Enter the Marks</th>
		<th></th>
	</tr>
	@foreach($essays as $essay)
		<tr>
			<td> {{ $essay->member_id }} </td>
			<td> {{ $essay->paper_id }} </td>
			{{Form::open(array('url'=>'admin/paper/essay/marking'))  }}
			{{ Form::hidden('id', $essay->id) }}
			<td>{{ Form::text('marks') }}</td>
			<td> {{ Form::submit('Mark', array('class'=>'btn btn-info')) }} </td>
			{{ Form::close() }}
		</tr>
	@endforeach
</table>
<div> {{$essays->links()}} </div>
@stop