@extends('layouts.main')

@section('content')
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
				<img src="{{ url() }}/images/slider1.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
				<p>To enjoy the glow of good health, you must exercise</p>
			</li>
			<h1 id="breadcrumb">ABOUT US</h1>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12 col-md-3">
			<h3>Overview</h3>
			<ul id="overview-wrapper">
				<li><h5>Founded</h5><p>2001</p></li>
				<li><h5>Founder</h5><p>J.J Thompson</p></li>
				<li><h5>Active Members</h5><p>279</p></li>
			</ul>
		</div>
		<div class="col-xs-12 col-md-9">
			<h3>Our Services</h3>
			<p>The GPA is committed to the concept of continuing professional education. The GPA offers it’s members advanced training and lectures from renowned and well experienced physiotherapists.</p>
			<p>The GPA maintains an up to-date database of the active physiotherapists in Sri Lanka. This will enable authenticity and ensure the profession maintains a high standard.</p>
			<p>Throughout the year GPA plans and implements various awareness programmes to make the general public aware about physiotherapy. This includes online and offline campaigns, workshops and seminars.</p>
			<h4>Vision</h4>
			<p>To have Consumers of Physiotherapy in all Environments, be it patient management, Rehabilitation, Prevention or Wellness services within srilanka, receive Physiotherapy from a well qualified Physiotherapist whom the GPA would without any hesitation recommend.</p>
			<h4>Mission</h4>
			<p>The mission of the Government Physiotherapists' Association (GPA) is to raise the professional status through protecting, promoting and furthering the interests of the members by promoting or organizing all lawful means, and, through ameliorating the economic condition, the general welfare and well being of the members. The GPA's mission extends to educate the membership in Trade Unionism and the performance of faithful and efficient service.</p>
			</div>
	</div>
</div>
@stop