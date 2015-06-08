@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif

</br>
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
			<td> 
				@if($essay->state == 1)
					{{'Aproval pending'}}
				@elseif($essay->state == 2)
					{{'Allowed to participate'}}
				@elseif($essay->state == 3)
					{{'Completed'}}
				@elseif($essay->state == 4)
					{{'Terminated by system'}}
				@elseif($essay->state == 5)
					{{'In progress'}}
				@endif
			 </td>
			<td> {{ $essay->start_time }}</td>
			<td> {{ $essay->end_time }}</td>
			{{Form::open(array('url'=>'admin/paper/essay/paper'))  }}
			{{ Form::hidden('id', $essay->id) }}
			<td> {{ Form::submit('Mark', array('class'=>'btn btn-info')) }} </td>
			{{ Form::close() }}
		</tr>
	@endforeach
</table>
<div> {{$essays->links()}} </div>
@stop