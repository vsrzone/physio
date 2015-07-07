<?php 
	$page = 'exams';
?>

@extends('layouts.main')
<?php  
	$page = 'exams';
	$title = Session::pull('title');
	$marks = Session::pull('marks');
	$hours = Session::pull('hours');
	$mins = Session::pull('mins');
	$seconds = Session::pull('seconds');
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
			<h2>You have Successfully Completed the Exam: {{ $title }}</h2>
			<h3>Your Marks: {{ $marks }}</h3>
			<h3>Time Taken: 
				@if($hours > 0)
					{{$hours}} hours {{$mins}} minutes {{$seconds}} seconds.
				@elseif($hours == 0 && $mins > 0)
					{{$mins}} minutes {{$seconds}} seconds.
				@else
					{{$seconds}} seconds.
				@endif
			</h3>
		</div>
	</div>
</div>

@stop