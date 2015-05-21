@extends('layouts.main')

@section('content')
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
			<img src="{{ url() }}/images/slider5.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
			</li>
		</ul>
	</div>
</div>

@if(!$type)
	<div>
		Are you sure you want to get registered for the selected examination?

		{{ Form::open(array('url'=>'members/exam/register')) }}
		{{ Form::hidden('id', Input::get('id')) }}
		{{ Form::submit('Yes') }}
		{{ Form::close() }}
		{{ Form::open(array('url'=>'members/exams', 'method'=>'GET')) }}
		{{ Form::submit('No') }}
		{{ Form::close() }}
	</div>
@elseif($type->state == 1)
	<div>
		You have registered for the selected examination.

		
		{{ Form::open(array('url'=>'members/exams', 'method'=>'GET')) }}
		{{ Form::submit('Back') }}
		{{ Form::close() }}
	</div>
@elseif($type->state == 2)
	<div>
		Are you sure you want start answering the selected examination?

		{{ Form::open(array('url'=>'members/exam/answer')) }}
		{{ Form::hidden('id', Input::get('id')) }}
		{{ Form::submit('Yes') }}
		{{ Form::close() }}
		{{ Form::open(array('url'=>'members/exams', 'method'=>'GET')) }}
		{{ Form::submit('No') }}
		{{ Form::close() }}
	</div>
@elseif($type->state == 3)
	<div>
		You have sat for the selected examination.

		
		{{ Form::open(array('url'=>'members/exams', 'method'=>'GET')) }}
		{{ Form::submit('Back') }}
		{{ Form::close() }}
	</div>
@elseif($type->state == 4 || $type->state == 5)
	<div>
		Are you sure you want to get re-registered for the selected examination?

		{{ Form::open(array('url'=>'members/exams/register')) }}
		{{ Form::hidden('id', Input::get('id')) }}
		{{ Form::submit('Yes') }}
		{{ Form::close() }}
		{{ Form::open(array('url'=>'members/exams', 'method'=>'GET')) }}
		{{ Form::submit('No') }}
		{{ Form::close() }}
	</div>
@endif

@stop