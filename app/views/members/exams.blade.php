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
				<li>					
					<h4>{{$exam->title}}</h4>
					<p>{{$exam->description}}</p>
					<input class="btn" type="button" value="Register for Exam" data-toggle="modal" data-target="#confirm-modal" id="takeExam">
					
				</li>				
				@endforeach					
				@foreach($acceptances as $acceptance)
				<li>
					<h4>{{$exam->title}}</h4>
					<p>{{$exam->description}}</p>

					<input class="btn" type="button" value="Pending approval" data-toggle="modal" data-target="#confirm-modal" id="takeExam">
					<input class="btn" type="button" value="Take Exam" data-toggle="modal" data-target="#confirm-modal" id="takeExam">
				</li>		
				@endforeach						
			</ul>
		</div>
		<div class="col-xs-12 col-md-3 exams-container">
			<h4>Examinations Already done</h4>
			<ul id="exams-taken">
				<li>
					<p>Examination Name</p>
					<span>Marks : 50</span>
				</li>
				<li>
					<p>Examination Name</p>
					<span>Marks : 72</span>
				</li>
				<li>
					<p>Examination Name</p>
					<span>Marks : 68</span>
				</li>
			</ul>
		</div>
	</div>
</div>


<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="loginModelLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="login-area">
				<h3>Are you sure you want to register?</h3>
				{{ Form::open(array('url'=>'members/exam')) }}
				{{ Form::hidden('id', '', array('id'=>'mod_exam_id')) }}
				<input class="btn" type="submit" value="Yes">
				{{ Form::close() }}
				<input class="btn" type="button" value="No">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exam-modal" tabindex="-1" role="dialog" aria-labelledby="loginModelLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="login-area">
				<h3>Are you sure you want to take this examination?</h3>
				<input class="btn" type="button" value="Yes">
				<input class="btn" type="button" value="No">
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.getElementById('takeExam').onclick = function(){		
		loadToConfirmModel();
	}

	var loadToConfirmModel = function(){
		document.getElementById('mod_exam_id').value = document.getElementById('exam_id').value;
	}
</script>
@stop