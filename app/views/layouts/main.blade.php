<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Physiotherapy Association</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:700,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="{{ url() }}/style.css">
	<link rel="stylesheet" type="text/css" href="{{ url() }}/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url() }}/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url() }}/css/flexslider.css">
</head>
<body>
 <div id="page">
	<div class="login-container-wrapper">
		<nav class="">
			<div id="login-container">
				<div id="login" class="col-xs-12">
					@if(Auth::check())
					<button class="btn"><a href="{{url()}}/member/logout">Signout</a></button>
					@else
					<button class="btn" data-toggle="modal" data-target="#login-modal">Login</button>
					@endif

					@if(Auth::check())
						@if(Auth::user()->type == 1 || Auth::user()->type == 2)
						<label><a href="{{ url() }}/admin">Admin</a></label>
						@elseif(Auth::user()->type == 3)
						<label><a href="{{ url() }}/members/{{ Auth::user()->member_id}}">Profile</a></label>
						@endif
					@else
						<label>Member</label>
					@endif

				</div>
			</div>
			<!-- <div id="logo" class="col-md-2">
				<a href="{{ url() }}" target="_self"><img src="{{ url() }}/images/logo.png" width="auto" height="100%" alt="Physiotherapysts Association" title="Physiotherapysts Association"></a>
			</div> -->
		</nav>
	</div>


	<div id="nav">
		<ul>
			<li <?php  if ($page == 'home') { echo 'class="active"'; } ?>><a href="{{ url() }}/">HOME</a></li>
			<li <?php  if ($page == 'about') { echo 'class="active"'; } ?>><a href="{{ url() }}/about">ABOUT</a></li>
			<li <?php  if ($page == 'news') { echo 'class="active"'; } ?>><a href="{{ url() }}/news">NEWS</a></li>
			<li <?php  if ($page == 'members') { echo 'class="active"'; } ?>><a href="{{ url() }}/members">MEMBERS</a></li>
			<li <?php  if ($page == 'exams') { echo 'class="active"'; } ?>><a href="{{ url() }}/members/exams">EXAMS</a></li>
			<li <?php  if ($page == 'learn') { echo 'class="active"'; } ?>><a href="{{ url() }}/learn">LEARN</a></li>
			<li <?php  if ($page == 'contact') { echo 'class="active"'; } ?>><a href="{{ url() }}/contact">CONTACT</a></li>
		</ul>
	</div>
	<section>
		@yield('content')
	</section>



</div>
<!-- Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="loginModelLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="login-area">
				<h3>Login to GPA</h3>
				<p>Login to view member exclusive content and to end your profile</p>
				<div>
				{{ Form::open(array('url'=>'admin/login')) }}
				<label>Username</label>
				{{ Form::email('email','', array('placeholder'=>'User name')) }}
				<label>Password</label>
				{{ Form::password('password', array('placeholder'=>'Password')) }}<br/>
				{{ Form::checkbox('remember') }} Remeber Me <br/>
				<input type="submit" value="Sign in" class="btn" id="sign-in"/>
				{{ Form::close() }}	
				</div>
			</div>
		</div>
	</div>
</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{ url() }}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ url() }}/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="{{ url() }}/js/libs.js"></script>

<script type="text/javascript">

var page = '<?php echo $page; ?>';
console.log(page);

var noItems = 4;
$(document).ready(function() {
	@if(Session::has('login_popup'))  //php
	$('#login button').eq(0).click();
	@endif		//php
	var w = window.innerWidth;
	if(w < 768) {
		noItems = 2;
	}

	$(window).load(function() {
	  $('.flexslider').flexslider({
	    animation: "slide"
	  });
	});
	  // The slider being synced must be initialized first
	$('#news-carousel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 210,
		itemMargin: 5,
		minItems: noItems,
		maxItems: noItems,
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

window.onresize = function(){
	var w = window.innerWidth;
	if(w < 768) {
		$('#news-carousel').data().flexslider.vars.minItems = 2;
		$('#news-carousel').data().flexslider.vars.maxItems = 2;
	}else{
		$('#news-carousel').data().flexslider.vars.minItems = 4;
		$('#news-carousel').data().flexslider.vars.maxItems = 4;
	}


}
	
</script>

</html>