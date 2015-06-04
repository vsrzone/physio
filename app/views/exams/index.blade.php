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
				<li>
					<h4>Sample Exam</h4>
					<p>Tiny description of the exam Tiny description of the examTiny description of the exam</p>
					<input class="btn" type="button" value="Register" data-toggle="modal" data-target="#confirm-modal">
					<span class="pending-reg">Pending Registration</span>
					<input class="btn" type="button" value="Take Exam" data-toggle="modal" data-target="#exam-modal">
				</li>
				<li>
					<h4>Sample Exam</h4>
					<p>Tiny description of the exam Tiny description of the examTiny description of the examTiny description of the exam</p>
					<input class="btn" type="button" value="Register">
				</li>
				<li>
					<h4>Sample Exam</h4>
					<p>Tiny description of the examTiny description of the examTiny description of the examTiny description of the examTiny description of the exam</p>
					<input class="btn" type="button" value="Register">
				</li>
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
				<input class="btn" type="button" value="Yes">
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

@stop