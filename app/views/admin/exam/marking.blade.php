@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif

<ul class="nav nav-tabs">
	<li class="active">
		<a data-toggle="tab" aria-expanded="true" href="{{url()}}/admin/paper/essay/changestate#two">Change the Statue</a>
	</li>
	<li class>
		<a data-toggle="tab" aria-expanded="false" href="{{url()}}/admin/paper/essay/formarking#two">Papers Available for Marking</a>
	</li>
	<li class>
		<a data-toggle="tab" aria-expanded="false" href="{{url()}}/admin/paper/essay/results#two">View Results</a>
	</li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade" id="two"></div>
</div>


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
			
			@if($essay->state === 1)
			{{Form::open(array('url'=>'admin/paper/essay/changestate'))  }}
			{{ Form::hidden('id', $essay->id) }}
			<td> {{ Form::submit('Enable', array('class'=>'btn btn-info')) }} </td>
			@elseif($essay->marks === null)
			{{Form::open(array('url'=>'admin/paper/essay/paper'))  }}
			{{ Form::hidden('id', $essay->id) }}
			<td> {{ Form::submit('Mark', array('class'=>'btn btn-info')) }} </td>
			@else
			{{Form::open(array('url'=>'admin/paper/essay/results'))  }}
			{{ Form::hidden('id', $essay->id) }}
			<td> {{ Form::submit('View Answer', array('class'=>'btn btn-info')) }} </td>
			@endif
			{{ Form::close() }}
		</tr>
	@endforeach
</table>
<div> {{$essays->links()}} </div>
@stop