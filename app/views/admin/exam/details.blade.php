@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif

<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>Paper</th>
		<th>Member</th>
		<th>Examination status</th>		
		<th>Marks</th>
		<th>Paper start time</th>
		<th>Paper end time</th>
		<th colspan="2"></th>
	</tr>
	@foreach($exams as $exam)
		<tr>
			<td> {{ $exam->paper_id }} </td>
			<td> {{ $exam->name.' ['.$exam->member_id.']' }} </td>
			<td> 
				@if($exam->state == 1)
					{{'Aproval pending'}}
				@elseif($exam->state == 2)
					{{'Allowed to participate'}}
				@elseif($exam->state == 3)
					{{'Completed'}}
				@elseif($exam->state == 4)
					{{'Terminated by system'}}
				@elseif($exam->state == 5)
					{{'In progress'}}
				@endif
			 </td>
			<td> {{ $exam->marks }} </td>
			<td> {{ $exam->start_time }} </td>
			<td> {{ $exam->end_time }} </td>
			{{Form::open(array('url'=>'admin/exam/postenablestatus'))  }}
			{{ Form::hidden('id', $exam->acceptance_id) }}
			@if($exam->state === 1)
			<td> {{ Form::submit('Accept', array('class'=>'btn btn-info')) }} </td>
			@elseif ($exam->state >= 2)
			<td> {{ Form::submit('Accepted', array('class'=>'btn btn-success')) }} </td>
			@endif
			{{ Form::close() }}
		</tr>
	@endforeach
</table>
<div> {{$exams->links()}} </div>
@stop