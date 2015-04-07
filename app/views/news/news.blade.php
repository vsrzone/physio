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

			<ul id="news-cat"> 
				@foreach(json_decode($categories) as $category)
				<li><p>{{ $category->name }}</p></li>
				@endforeach
			</ul>
		</div>
		<div class="col-xs-12 col-md-9">
			<ul id="news-content">
				<li>
					@foreach($news as $news_item)
					<h3 class="">{{$news_item->title}}</h3>
					<ul class="news-content-cat">
						<li>{{$news_item->category_name}}</li>
					</ul>
					<img src="{{ url() }}/uploads/images/{{$news_item->image}}" alt="{{$news_item->title}}" title="{{$news_item->title}}">
					<p>{{$news_item->content}}</p>
					<a href="{{ url() }}/news/{{$news_item->news_id}}">Read More</a>
					<p>{{$news_item->news_date}}</p>
					@endforeach
				</li><!-- end of news -->
			</ul>
		</div>
	</div>
</div>

@stop