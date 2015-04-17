@extends('layouts.main')

@section('content')
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
				<img src="{{ url() }}/images/slider.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
				<p>"You're in pretty good shape for the shape you are in You're in pretty good shape for the shape you are in"</p>
			</li>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="content-wrapper">
	<div class="row">
		<div class="col-xs-12">
			<h1>Government Physiotherapists’ Association</h1>
			<p>The Government Physiotherapists ’Association is the sole voice for Government Physiotherapists, representing 325 physiotherapists’ island wide .The Association operates as a non-profit organization and is registered in1957 as a trade union under the trade union ordinance. Although the association is a trade union, it works for social wellbeing as an organization while it works to protect, promote the interests of its members in respect of their prospects and privileges and general conditions of employment.</p>
			<ul id="services">
				<li class="col-xs-12 col-md-4">
					<p><img src=""><span class="glyphicon glyphicon-star" aria-hidden="true"></span></p>
					<h5>Education</h5>
					<p>The GPA is committed to the concept of continuing professional education. The

GPA offers it’s members advanced training and lectures from renowned and well 

experienced physiotherapists.</p>
				</li>
				<li class="col-xs-12 col-md-4">
					<p><img src=""><span class="glyphicon glyphicon-indent-right" aria-hidden="true"></span></p>
					<h5>Membership</h5>
					<p>Throughout the year GPA plans and implements various awareness programmes

to make the general public aware about physiotherapy. This includes online and offline 

campaigns, workshops and seminars.</p>
				</li>
				<li class="col-xs-12 col-md-4">
					<p><img src=""><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></p>
					<h5>Awareness</h5>
					<p>SuspendisseThroughout the year GPA plans and implements various awareness programmes

to make the general public aware about physiotherapy. This includes online and offline 

campaigns, workshops and seminars.</p>
				</li>
			</ul>
		</div>
		<div class="col-xs-12" id="news-section">
			<h3>Latest News</h3>
			<div id="news-slider" class="flexslider">
				<ul class="slides">
					@foreach($latest_news as $news_item)
					<li>
						<a href="{{ url() }}/news/{{$news_item->id}}">
							<img src="{{ url() }}/slider?image={{url().'/uploads/images/'.$news_item->image}}">
							<p>{{$news_item->title}}...</p>
							<p>{{$news_item->summary}}...</p>
						</a>
					</li>
					@endforeach
				</ul>
			</div>
			<div id="news-carousel" class="flexslider">
				<ul class="slides">
					@foreach($latest_news as $news_item)
					<li><img src="{{ url() }}/slider?image={{url().'/uploads/images/'.$news_item->image}}"></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@stop