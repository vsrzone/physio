@extends('layouts.main')

@section('content')
	<ul id="slider" class="col-xs-12">
		<li>
			<img src="images/slider.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
			<h2>You're in pretty good shape for the shape you are in</h2>
		</li>
	</ul>
	<div class="col-xs-12 col-md-3" id="news-section">
		<h3>News Feed</h3>
		<ul id="news">
			<li>
				<a href="">
					<img src="images/news.jpg" width="100%" height="auto" alt="news" title="news">
					<h5>Aenean sed semper urna.</h5>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate suscipit dictum.</p>
				</a>
			</li>
			<li>
				<a href="">
					<img src="images/news.jpg" width="100%" height="auto" alt="news" title="news">
					<h5>Nunc molestie euismod</h5>
					<p>Aliquam erat volutpat. Aliquam lacinia vel lorem id finibus.</p>
				</a>
			</li>
		</ul>
		<h4>Latest Members</h4>
		<ul id="latest-members">
			<li>
				<img src="images/members/member1.jpg" width="100%" height="auto" alt="member" title="member">
			</li>
			<li>
				<img src="images/members/member2.jpg" width="100%" height="auto" alt="member" title="member">
			</li>
			<li>
				<img src="images/members/member3.jpg" width="100%" height="auto" alt="member" title="member">
			</li>
		</ul>
	</div>
	<div class="col-xs-12 col-md-9">
		<h3>Our Services</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate suscipit dictum. Donec convallis sapien elit. Cras vitae orci quis nisl tristique scelerisque et at augue. Fusce finibus vulputate justo. In sagittis vitae ligula sed tristique. Quisque venenatis lectus malesuada lacus porttitor, quis molestie nisl tristique. Suspendisse maximus venenatis massa, eu fringilla ipsum efficitur vel. Vestibulum mollis purus nisi, vitae ornare massa consectetur at.</p>
		<ul id="services">
			<li class="col-xs-12 col-md-4">
				<a href=""><img src=""><span class="glyphicon glyphicon-star" aria-hidden="true"></span></a>
				<h5>Service 1</h5>
				<p>Sed et ex semper, euismod erat eu, iaculis odio.</p>
			</li>
			<li class="col-xs-12 col-md-4">
				<a href=""><img src=""><span class="glyphicon glyphicon-indent-right" aria-hidden="true"></span></a>
				<h5>Service 2</h5>
				<p>Proin sit amet turpis sit amet felis rhoncus commodo at quis risus.</p>
			</li>
			<li class="col-xs-12 col-md-4">
				<a href=""><img src=""><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
				<h5>Service 3</h5>
				<p>In tellus ipsum, rutrum vel velit sit amet, luctus consequat risus.</p>
			</li>
		</ul>
	</div>

@stop