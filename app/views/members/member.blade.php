@extends('layouts.main')

@section('content')
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
			<img src="{{ url() }}/uploads/member/cover/{{$member[0]->cover_picture}}" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
			</li>
		</ul>
	</div>
</div>

<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12 col-sm-3" id="member-info">
			<h3>{{$first_name}} <span id="member-second-name">{{$last_name}}</span></h3>
			<!-- <p>sub-heading</p> -->
			<img src="{{ url() }}/uploads/member/profile/{{$member[0]->profile_picture}}" title="{{$first_name}}" alt="{{$first_name}}">
			<div id="member-personal">
				<p class="member-sub-heading">Phone<br/><span><a href="tel:+94723074931">{{$member[0]->tp1}}</a></span></p>
				<p class="member-sub-heading">Email<br/><span>{{$member[0]->email}}</span></p>
				<p class="member-sub-heading">Address<br/>
				<span>
					<?php
						if($address) {

							for ($i=0; $i <= sizeof($address)-1; $i++) { 
								if($i === sizeof($address)-1) {

									echo $address[$i]."<br>";
								}
								
								else {

									echo $address[$i].",<br>";
								}
							}
						}
						
					?>

				</span></p>
			</div>
		</div>
		<div class="col-xs-12 col-sm-9" id="member-wrapper">
			<div id="member-details">
				<h3>Qualifications</h3>
				<p>{{$member[0]->qualifications}}</p>
				<h3>Registration Details</h3>
				<p>Registration No: {{$member[0]->concil_registration_no}}</p>
				<p>Hospital: {{$member[0]->hospital}}</p>
				<p>NIC No: {{$member[0]->nic}}</p>
				<p>District : {{$member[0]->district}}</p>
			</div>
		</div>
	</div>
</div>
@stop