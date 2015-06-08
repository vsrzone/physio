<?php 
	$page = 'exams';
?>

@extends('layouts.main')
<?php  
	$page = 'exams';
?>
@section('content')
<div id="banner-container">
		<ul id="main-slider" class="">
			<li style="background-image:url({{ url() }}/images/slider/01.jpg)">
				<p>"Looking after your health today gives you a better hope for tomorrow."</p>
			</li>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12 col-md-9 exams-container">
			<h3>Available Examinations</h3>

			<ul>
				@foreach($exams as $exam)	
				{{ Form::open(array('url'=>'members/exam')) }}			
				<li>					
					<h4>{{$exam->title}}</h4>
					<p>{{$exam->description}}</p>
					{{Form::hidden('id', $exam->id, array('id'=>'exam_id'))}}
					<input class="btn" type="submit" value="Take exam" id="takeExam">
					
				</li>	
				{{ Form::close() }}			
				@endforeach				
									
			</ul>
		</div>
		<div class="col-xs-12 col-md-3 exams-container">
			<h4>Examinations Already done</h4>
			<ul id="exams-taken">
				@foreach($marks as $marks_record)
				<li>
					<p>{{$marks_record->title}}</p>
					<span>Marks : {{$marks_record->marks}}</span>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

@stop