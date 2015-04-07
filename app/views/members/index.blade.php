@extends('layouts.main')

@section('content')
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
				<img src="{{ url() }}/images/slider1.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
				<p>To enjoy the glow of good health, you must exercise</p>
			</li>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12" id="members-wrapper">
			<ul>
				@foreach($members as $member)
				<li>
					<p><a href="{{url()}}/members/{{$member->id}}"><img src="{{ url() }}/uploads/member/profile/{{$member->profile_picture}}" alt="{{$member->name}}" title="{{$member->name}}" /></a></p>
					<p>{{$member->name}}</p>
					<p>{{$member->concil_registration_no}}</p>
					<p>{{$member->nic}}</p>
					<p>{{$member->hospital}}</p>
					<p>{{$member->district}}</p>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@stop