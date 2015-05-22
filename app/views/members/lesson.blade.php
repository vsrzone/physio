@extends('layouts.main')

@section('content')
<style type="text/css"></style>
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
				<img src="{{ url() }}/images/slider5.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
				<p>To enjoy the glow of good health, you must exercise</p>
			</li>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<h1>Available Lessons</h1>
		<div class="col-xs-12" id="members-wrappers">
				@foreach($lessons as $lesson)
					<h2>{{$lesson->topic}}</h2>
					<a href="{{url()}}/member/lesson/{{$lesson->id}}">Go to the Lesson</a>
				@endforeach
		</div>
		{{ $lessons->links() }}
	</div>
</div>
@stop