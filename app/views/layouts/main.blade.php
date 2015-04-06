<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Physiotherapy Association</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:700,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="{{ url() }}/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url() }}/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url() }}/css/flexslider.css">
</head>
<body>

	<div class="container">
		<nav class="row">
			<div id="login-container">
				<div id="login" class="col-xs-12">
					<button class="btn">Login</button>
					<label>Member</label>
				</div>
			</div>
			<div id="logo" class="col-md-4">
				<a href="{{ url() }}" target="_self"><img src="{{ url() }}/images/logo.png" width="auto" height="100%" alt="Physiotherapysts Association" title="Physiotherapysts Association"></a>
			</div>
			<ul id="nav" class="col-md-8">
				<div class="navbar-header mobile-toggle">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<li class="col-xs-12 col-sm-3 col-md-3"><a href="{{ url() }}">Home</a></li>
					<li class="col-xs-12 col-sm-3 col-md-3"><a href="{{ url() }}/about">About Us</a></li>
					<li class="col-xs-12 col-sm-3 col-md-3"><a href="{{ url() }}/news">News & Events</a></li>
					<li class="col-xs-12 col-sm-3 col-md-3"><a href="{{ url() }}/contact">Contact Us</a></li>
				</div>
			</ul>
		</nav>
	</div>



<section>
	@yield('content')
</section>


<footer>
	<div class="container" id="footer-wrapper">
		<div class="col-xs-* col-md-9 nopadding" id="bottom-nav-container">
			<ul id="secondary-nav">
				<li>
					<a href="{{ url() }}/about">About Us</a>
				</li>
				<li>
					<a href="{{ url() }}/members">Members</a>
				</li>
				<li>
					<a href="{{ url() }}/contact">Contact Us</a>
				</li>
				<li>
					<a href="{{ url() }}/privacy">Privacy Policy</a>
				</li>
				<li>
					<a href="{{ url() }}/terms">Terms and Conditions</a>
				</li>
			</ul>
		</div>
		<div class="col-xs-12 col-md-3 nopadding" id="copyrights">
			<p>Copyright © GPA2015<br/>Design and Development by <a href="http://ingenslk.com">INGENS</a></p>
		</div>
	</div>
</footer>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{ url() }}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ url() }}/js/jquery.flexslider-min.js"></script>

<script type="text/javascript">

$(window).load(function() {
  // The slider being synced must be initialized first
  $('#news-carousel').flexslider({
	    animation: "slide",
	    controlNav: false,
	    animationLoop: false,
	    slideshow: false,
	    itemWidth: 210,
	    itemMargin: 5,
	    minItems: 2,
	    maxItems: 4,
	    asNavFor: '#news-slider'
	  });
	   
	  $('#news-slider').flexslider({
	    animation: "slide",
	    controlNav: false,
	    directionNav: false,
	    animationLoop: false,
	    slideshow: false,
	    sync: "#news-carousel"
	  });
	});

</script>

</html>