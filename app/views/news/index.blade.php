<?php 
	$page = 'news';
?>

@extends('layouts.main')

<?php  
	$page = 'news';
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
		<div class="col-xs-12 col-md-9">
			<ul id="news-content">
				@foreach($news as $news_item)
				<li>
					<h3 class="">{{$news_item->title}}...</h3>
					<ul class="news-content-cat">
						<li>{{$news_item->category_name}}</li>
					</ul>
					<img src="{{ url() }}/thumbnail?image={{url().'/uploads/images/'.$news_item->image}}" alt="{{$news_item->title}}" title="{{$news_item->title}}">
					<p>{{$news_item->summary}}...</p>
					<a href="{{ url() }}/news/{{$news_item->news_id}}">Read More</a>
					<?php $date = date_create($news_item->news_date);?>
					<p>{{date_format($date, 'Y-m-d')}}</p>
				</li><!-- end of news -->
				@endforeach
			</ul>
			{{$news->links()}}
		</div>
		<div class="col-xs-12 col-md-3">
			<h3>News Categories</h3>

			<ul id="news-cat"> 
				<li><a href="{{url()}}/news"><p>All News</p></a></li>
				@foreach(json_decode($categories) as $category)
				<li><a href="{{url()}}/news/category/{{$category->id}}"><p>{{ $category->name }}</p></a></li>
				@endforeach
				<li><a href="{{url()}}/news/member"><p>Members Only</p></a></li>
			</ul>
		</div>
	</div>
</div>

@stop