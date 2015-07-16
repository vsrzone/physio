<?php  
	$page = 'home';
?>

@extends('layouts.main')

@section('content')
<div id="slider-container">
	<div class="flexslider">
		<ul id="main-slider" class="slides">
			<li style="background-image:url({{ url() }}/images/slider/01.jpg)">
				<p>"Looking after your health today gives you a better hope for tomorrow."</p>
			</li>
			<li style="background-image:url({{ url() }}/images/slider/02.jpg)">
				<p>"Looking after your health today gives you a better hope for tomorrow."</p>
			</li>
			<li style="background-image:url({{ url() }}/images/slider/03.jpg)">
				<p>"Looking after your health today gives you a better hope for tomorrow."</p>
			</li>
		</ul>
	</div>
</div>
<div class="page-wrapper" id="content-wrapper">
	<div>
		<div>
			<h1>Government Physiotherapists’ Association</h1>
			<p>The Government Physiotherapists ’Association is the sole voice for Government Physiotherapists, representing 325 physiotherapists’ island wide .The Association operates as a non-profit organization and is registered in1957 as a trade union under the trade union ordinance. Although the association is a trade union, it works for social wellbeing as an organization while it works to protect, promote the interests of its members in respect of their prospects and privileges and general conditions of employment.</p>
			
			<ul id="services">
				<li>
					<p><img src="{{ url() }}/images/services_icons/education.png"></p>
					<h5>Education</h5>
					<p>The GPA is committed to the concept of continuing professional education. The

GPA offers it’s members advanced training and lectures from renowned and well 

experienced physiotherapists.</p>
				</li>
				<li>
					<p><img src="{{ url() }}/images/services_icons/membership.png"></p>
					<h5>Membership</h5>
					<p>Throughout the year GPA plans and implements various awareness programmes

to make the general public aware about physiotherapy. This includes online and offline 

campaigns, workshops and seminars.</p>
				</li>
				<li>
					<p><img src="{{ url() }}/images/services_icons/horn.png"></p>
					<h5>Awareness</h5>
					<p>SuspendisseThroughout the year GPA plans and implements various awareness programmes

to make the general public aware about physiotherapy. This includes online and offline 

campaigns, workshops and seminars.</p>
				</li>
			</ul>

		</div>
		<div id="news-section">
			<div id="news-events">
				<h4>EVENTS</h4>
				<ul>	
					@foreach($latest_events as $event)
					<li>
						<div class="event-date">
							<?php $month = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"] ?>
							<span>{{$event->day}}</span></br>
							<span>{{$month[$event->month-1]}}</span>
						</div>
						<div class="event-details">
							<h5><a href="{{url()}}/news/{{$event->id}}">{{$event->title}}</a></h5>
							<p>{{$event->summary}}</p>
						</div>
					</li>
					@endforeach					
				</ul>
			</div>
			<div id="news-latest">
				<h4>NEWS</h4>
				<ul>
					@foreach($latest_news as $news)
					<li>
						<div class="latest-img" style="background-image:url({{ url() }}/uploads/images/{{$news->image}});"></div>
						<h5><a href="{{url()}}/news/{{$news->id}}">{{$news->title}}</a></h5>						
						<p>{{$news->summary}}</p>
					</li>
					@endforeach					
				</ul>
			</div>
		</div>

		<!-- <div class="col-xs-12" id="news-section">
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
		</div> -->
	</div>
</div>
@stop