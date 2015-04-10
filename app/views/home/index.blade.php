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