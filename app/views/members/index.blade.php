@extends('layouts.main')

@section('content')
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
				<img src="images/slider1.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
				<p>To enjoy the glow of good health, you must exercise</p>
			</li>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12" id="members-wrapper">
			<ul>
				<li>
					<p>Name</p>
					<p>Picture</p>
					<p>Registration No</p>
					<p>NIC No</p>
					<p>Hospital</p>
					<p>District</p>
				</li>
				<li>
					<p>Jon Doe</p>
					<p><img src="{{ url() }}/images/members/member1.jpg" alt="" title="" /></p>
					<p>N31274</p>
					<p>74637382v</p>
					<p>General Hospital Colomboasdasdasdasdasd</p>
					<p>Dehiwala</p>
				</li>
				<li>
					<p>Jon Doe</p>
					<p><img src="{{ url() }}/images/members/member1.jpg" alt="" title="" /></p>
					<p>N31274</p>
					<p>74637382v</p>
					<p>General Hospital Colomboasdasdasdasdasd</p>
					<p>Dehiwala</p>
				</li>
				<li>
					<p>Jon Doe</p>
					<p><img src="{{ url() }}/images/members/member1.jpg" alt="" title="" /></p>
					<p>N31274</p>
					<p>74637382v</p>
					<p>General Hospital Colomboasdasdasdasdasd</p>
					<p>Dehiwala</p>
				</li>
				<li>
					<p>Jon Doe</p>
					<p><img src="{{ url() }}/images/members/member1.jpg" alt="" title="" /></p>
					<p>N31274</p>
					<p>74637382v</p>
					<p>General Hospital Colomboasdasdasdasdasd</p>
					<p>Dehiwala</p>
				</li>

			</ul>
		</div>
		<!-- <div class="col-xs-12 col-sm-3" id="member-info">
			<h3>Jon <span id="member-second-name">Doe</span></h3>
			<p>sub-heading</p>
			<img src="{{ url() }}/images/members/member1.jpg" title="member1" alt="member1">
			<div id="member-personal">
				<p class="member-sub-heading">Phone<br/><span><a href="tel:+94723074931">+94 72 307 4931</a></span></p>
				<p class="member-sub-heading">Email<br/><span>januka@ingenslk.com</span></p>
				<p class="member-sub-heading">Address<br/><span>Lorem ipsum,<br/> Lorem, Ipsum 11000.</span></p>
			</div>
		</div>
		<div class="col-xs-12 col-sm-9" id="member-wrapper">
			<div id="member-details">
				<h3>Qualifications</h3>
				<p>Bsc(Hons) Physiotherapy - University<br/>PhD Physiotherapy - Oxford University</p>
				<h3>Registration Details</h3>
				<p>Registration No: N31274</p>
				<p>Hospital: General Hospital Colombo</p>
				<p>NIC No: 74637382v</p>
				<p>District : Dehiwala</p>
			</div> -->
		</div>
	</div>
</div>
@stop