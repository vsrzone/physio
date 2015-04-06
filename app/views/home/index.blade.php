@extends('layouts.main')

@section('content')
<div class="container-fluid">
	<div class="row">
		<ul id="slider" class="col-xs-12">
			<li>
				<img src="images/slider.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
				<p>You're in pretty good shape for the shape you are in</p>
			</li>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="content-wrapper">
	<div class="row">
		<!-- <div class="col-xs-12 col-md-3" id="news-section">
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
		</div> -->
		<div class="col-xs-12">
			<h1>Physiotherapy</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate suscipit dictum. Donec convallis sapien elit. Cras vitae orci quis nisl tristique scelerisque et at augue. Fusce finibus vulputate justo. In sagittis vitae ligula sed tristique. Quisque venenatis lectus malesuada lacus porttitor, quis molestie nisl tristique. Suspendisse maximus venenatis massa, eu fringilla ipsum efficitur vel. Vestibulum mollis purus nisi, vitae ornare massa consectetur at.</p>
			<ul id="services">
				<li class="col-xs-12 col-md-4">
					<p><img src=""><span class="glyphicon glyphicon-star" aria-hidden="true"></span></p>
					<h5>Service 1</h5>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin suscipit tempor diam, et finibus felis hendrerit id. Praesent vitae ligula augue. Etiam tincidunt neque eu ante ultrices venenatis. Nunc vel gravida nibh. Quisque nulla ipsum, egestas vitae fringilla at, aliquam id nibh. Vivamus maximus nunc in auctor suscipit. Etiam vestibulum molestie odio, eu volutpat mauris blandit sed. Nam fringilla congue ex, eu ullamcorper felis vestibulum ut. Sed at tempor eros, nec iaculis risus. Nullam eu varius nisl. Pellentesque convallis justo eu convallis ullamcorper.</p>
				</li>
				<li class="col-xs-12 col-md-4">
					<p><img src=""><span class="glyphicon glyphicon-indent-right" aria-hidden="true"></span></p>
					<h5>Service 2</h5>
					<p>Aenean quis ex vel nunc facilisis faucibus. In id lectus scelerisque, fringilla sem in, suscipit ex. Pellentesque pretium nisi eu orci ullamcorper porta nec ut lorem. Nullam lobortis tincidunt semper. Sed venenatis aliquet ligula, facilisis facilisis tellus iaculis nec. Vestibulum massa dolor, hendrerit eu augue sit amet, viverra gravida tellus. Nullam facilisis accumsan molestie. Duis ac nisl eleifend, porttitor odio at, placerat ipsum. Phasellus interdum quam urna, a fermentum nisi cursus id. Aliquam tempus mauris quis mi pharetra, ut sollicitudin purus pellentesque.</p>
				</li>
				<li class="col-xs-12 col-md-4">
					<p><img src=""><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></p>
					<h5>Service 3</h5>
					<p>Suspendisse potenti. Sed id varius magna, quis tempor purus. Morbi magna mi, ultrices ac eros id, ultricies semper lectus. Fusce quam ex, finibus at ultricies id, imperdiet nec odio. Phasellus posuere vulputate dui, id fringilla leo efficitur bibendum. Aenean aliquam, lorem ac tristique pulvinar, mauris massa lobortis nisi, quis consectetur dui nisi efficitur justo. Etiam a ligula sit amet turpis tempor condimentum eu vitae metus. Suspendisse interdum quam felis, a interdum massa tristique ut. Ut non risus ac lacus porttitor interdum. Duis ac luctus nisl, ac eleifend lacus.</p>
				</li>
			</ul>
		</div>
	</div>
</div>
@stop