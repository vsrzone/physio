<?php 
	$page = 'learn';
?>

@extends('layouts.main')
<?php  
	$page = 'learn';
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
		<div class="col-xs-12 col-md-9 exams-container" >
			<h3>Available Learning Material</h3>

			<ul id="learning-topics">
				<li><a href=""><p>Learning topic Learning topic Learning topic Learning topic Learning topic Learning topic Learning topic Learning topic </p></a></li>
				<li><a href=""><p>Learning topic one twoLearning topic Learning topic Learning topic Learning topic Learning topic Learning topic Learning topic Learning topic </p></a></li>
				<li><a href=""><p>Learning topic three Learning topic Learning topic </p></a></li>
				<li><a href=""><p>Learning topic four Learning topic Learning topic Learning topic Learning topic </p></a></li>
				<li><a href=""><p>Learning topic fiveLearning topic Learning topic Learning topic Learning topic Learning topic Learning topic Learning topic Learning topic </p></a></li>
				<!-- -tiny mce here --
					<a href="">Download.docx</a>
					<a href="">sample.docx</a>
					<a href="">example.pdf</a> -->
			</ul>
		</div>
	</div>
</div>

@stop