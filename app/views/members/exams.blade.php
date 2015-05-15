@extends('layouts.main')

@section('content')
<h1>Your marks: {{$marks}}</h1>
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
			<img src="{{ url() }}/images/slider5.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
			</li>
		</ul>
	</div>
</div>

<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12" id="members-wrappers">
			<div class="well">			
				@foreach($exams as $exam)
				{{ Form::open(array('url'=>'members/exam')) }}
				<div class="panel panel-default">					
					<div class="panel-heading">{{$exam->title}}</div>
					<div class="panel-body">{{$exam->description}}</div> 
					{{ Form::hidden('id', $exam->id) }}
					{{ Form::submit('Try exam') }}  					            
				</div>
				{{ Form::close() }}     
				@endforeach	
		</div>
	</div>
</div>

@stop