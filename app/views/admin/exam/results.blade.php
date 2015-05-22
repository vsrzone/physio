@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif

<ul class="nav">
	<a style = "font-weight: bold; color: #FF0000;" href="{{url()}}/admin/paper/essay/changestate">Change the Statue</a>
	<a href="{{url()}}/admin/paper/essay/formarking">Papers Available for Marking</a>
	<a style = "font-weight: bold; color: #FF0000;" href="{{url()}}/admin/paper/essay/results">View Results</a>
</ul>
</br>
<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>Paper</th>
		<th>Member</th>
		<th>Examination Status</th>
		<th>Marks</th>
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
			 <td> {{ $essay->marks }}</td>
			<td> {{ $essay->start_time }}</td>
			<td> {{ $essay->end_time }}</td>
			{{Form::open(array('url'=>'admin/paper/essay/results'))  }}
			{{ Form::hidden('id', $essay->id) }}
			@if($essay->state === 1)
			<td> {{ Form::submit('Enable', array('class'=>'btn btn-info')) }} </td>
			@elseif($essay->marks === null)
			<td> {{ Form::submit('Mark', array('class'=>'btn btn-info')) }} </td>
			@else
			<td> {{ Form::submit('View Answer', array('class'=>'btn btn-info')) }} </td>
			@endif
			{{ Form::close() }}
		</tr>
	@endforeach
</table>
<div> {{$essays->links()}} </div>
@stop