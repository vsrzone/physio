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
			<li style="background-image:url({{ url() }}/images/slider/09.jpg)">
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
				@if(sizeOf($lessons) <= 0)
				<li>
					<p>No available learning materials</p>
				</li>
				@endif
				@foreach($lessons as $lesson)
					<li><a href="{{url()}}/member/lesson/{{$lesson->id}}"><p></p>{{$lesson->topic}}</a></li>					
				@endforeach
			</ul>
			{{$lessons->links()}}
		</div>
	</div>
</div>

@stop