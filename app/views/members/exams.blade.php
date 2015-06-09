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
			<h3>Available MCQ Examinations</h3>
			<ul>
				@if(sizeOf($exams) <= 0)
				<li>
					<p>No existing MCQ examinations</p>
				</li>
				@endif
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
			{{$exams->links()}}	
			<h3>Available Essay Examinations</h3>
			<ul>
				@if(sizeOf($essays) <= 0)
				<li>
					<p>No existing essay examinations</p>
				</li>
				@endif
				@foreach($essays as $essay)	
				{{ Form::open(array('url'=>'members/exam')) }}			
				<li>					
					<h4>{{$essay->title}}</h4>
					<p>{{$essay->description}}</p>
					{{Form::hidden('id', $essay->id, array('id'=>'exam_id'))}}
					<input class="btn" type="submit" value="Take exam" id="takeExam">
					
				</li>					
				{{ Form::close() }}			
				@endforeach				
									
			</ul>
			{{$essays->links()}}
		</div>
		<div class="col-xs-12 col-md-3 exams-container">
			<h4>Examinations Already done</h4>
			<ul id="exams-taken">
				@if(sizeOf($marks) <= 0)
				<li>
					<p>No previous exams</p>
				</li>
				@endif
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