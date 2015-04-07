@extends('layouts.main')

@section('content')
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
				<img src="{{ url() }}/images/slider3.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
				<p>To enjoy the glow of good health, you must exercise</p>
			</li>
			<h3 id="breadcrumb">News</h3>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12 col-md-3">
			<h3>Overview</h3>
			<p>sadasdasd asdasd asdas dasd asd</p>
		</div>
		<div class="col-xs-12 col-md-9" id="news-wrapper">
			<h3>{{$news[0]->title}}</h3>
			<p>{{$news[0]->content}}</p>
			@foreach($images as $image)
			<img src="{{url()}}/uploads/images/{{$image->name}}" alt="{{$news[0]->title}}" title="{{$news[0]->title}}">
			@endforeach
		</div>
	</div>
</div>

@stop