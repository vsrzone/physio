@extends('layouts.main')

@section('content')

	<ul id="slider" class="col-xs-12">
		<li>
			<img src="images/slider3.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
			<h2>To enjoy the glow of good health, you must exercise</h2>
		</li>
		<h3 id="breadcrumb">News</h3>
	</ul>
	<div class="col-xs-12 col-md-3" id="news-section">
		<h3>Overview</h3>

		<ul id="news-cat">
			<li><p>General</p></li>
			<li><p>Workshops</p></li>
			<li><p>Events</p></li>
			<li><p>Members Only</p></li>
		</ul>
	</div>
	<div class="col-xs-12 col-md-9">
		<ul id="news-content">
			<li>
				<h3 class="">Ut sed nulla sem</h3>
				<ul class="news-content-cat">
					<li>Workshops</li>
					<li>Events</li>
				</ul>
				<img src="{{ url() }}/images/news/news1.jpg" alt="News Title" title="News Title">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac diam libero. Donec nec semper ante. Quisque quis est ut urna feugiat sollicitudin vitae et nunc. Donec eu eros nulla. Suspendisse velit magna, blandit et tempus quis, condimentum sit amet dolor. Nunc accumsan cursus ultrices. Proin ac quam ac quam egestas bibendum. In ullamcorper facilisis enim vel lobortis. Praesent cursus nisl id est ultrices, a lacinia nunc ultricies.</p>
				<a href="">Read More</a>
				<p>2015.04.01</p>
			</li><!-- end of news -->
			<li>
				<h3 class="">Ut sed nulla sem</h3>
				<ul class="news-content-cat">
					<li>Workshops</li>
					<li>Events</li>
					<li>Tag</li>
				</ul>
				<img src="{{ url() }}/images/news/news1.jpg" alt="News Title" title="News Title">
				<p>Maecenas vitae libero tempor, dapibus urna sit amet, lobortis sapien. Proin augue ipsum, ultricies ac scelerisque convallis, vulputate in arcu. Donec hendrerit vitae nunc eu porttitor. </p>
				<a href="">Read More</a>
				<p>2015.04.01</p>
			</li><!-- end of news -->
			<li>
				<h3 class="">Ut sed nulla sem</h3>
				<ul class="news-content-cat">
					<li>Events</li>
				</ul>
				<img src="{{ url() }}/images/news/news1.jpg" alt="News Title" title="News Title">
				<p>Maecenas vitae libero tempor, dapibus urna sit amet, lobortis sapien. Proin augue ipsum, ultricies ac scelerisque convallis, vulputate in arcu. Donec hendrerit vitae nunc eu porttitor. </p>
				<a href="">Read More</a>
				<p>2015.04.01</p>
			</li><!-- end of news -->
		</ul>
	</div>

@stop