<?php 
	$page = 'members';
?>

@extends('layouts.main')
<?php 
	$page = 'members';
?>
@section('content')
<div id="banner-container">
		<ul id="main-slider" class="">
			<li style="background-image:url({{ url() }}/images/slider/04.jpg)">
				<p>"Looking after your health today gives you a better hope for tomorrow."</p>
			</li>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12" id="members-wrappers">
			<p>
				@if(isset($label))
					{{$label}}
					@if(!isset($members[0]))
						<br>No Results Found
					@endif
				@endif
			</p>
			<ul id="members-wrapper">
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

			{{ $members->links() }}

			{{ Form::open(array('url' => 'members', 'method' => 'GET')) }}
			{{ Form::label('Search Field')}}
			{{ Form::select('field', array('name'=>'Name', 'hospital'=>'Hospital', 'concil_registration_no'=>'Registration No', 'district'=>'District')) }}
			{{ Form::text('value') }}
			{{ Form::submit('Search', array('class'=>'btn')) }}
	    	
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop