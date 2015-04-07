@extends('admin.layouts.main')

@section('content')

{{ Form::open(array('url'=>'admin/member/update')) }}

{{ Form::hidden('id', $member->id) }}
{{ Form::label('Name')}}
{{ Form::text('name', $member->name, array('class'=>'form-control')) }}
<br>
{{ Form::label('Email')}}
{{ Form::email('email', $user->email, array('class'=>'form-control')) }}
<br>
{{ Form::label('Password')}}
{{ Form::password('password', array('class'=>'form-control')) }}
<br>
{{ Form::label('User Type')}}
{{ Form::select('type', array('1'=>'Super Admin', '2'=>'Admin', '3'=>'Member'), $user->type, array('class'=>'form-control')) }}
<br>
{{ Form::label('NIC')}}
{{ Form::text('nic', $member->nic, array('class'=>'form-control')) }}
<br>
{{ Form::label('Concil Registration No')}}
{{ Form::text('council_reg_no', $member->concil_registration_no, array('class'=>'form-control')) }}
<br>
{{ Form::label('Gender')}}
@if ($member->sex == 0)
	{{ Form::radio('sex', '0', true) }} Male {{ Form::radio('sex', '1') }} Female
@elseif ($member->sex == 1)
	{{ Form::radio('sex', '0') }} Male {{ Form::radio('sex', '1', true) }} Female
@endif

<br>
{{ Form::label('District')}}
{{ Form::select('district', array(
	'Ampara'=>'Ampara',
	'Anuradhapura'=>'Anuradhapura',
	'Badulla'=>'Badulla',
	'Batticaloa'=>'Batticaloa',
	'Colombo'=>'Colombo',
	'Galle'=>'Galle',
	'Gampaha'=>'Gampaha',
	'Hambantota'=>'Hambantota',
	'Jaffna'=>'Jaffna',
	'Kalutara'=>'Kalutara',
	'Kandy'=>'Kandy',
	'Kegalle'=>'Kegalle',
	'Kilinochchi'=>'Kilinochchi',
	'Kurunegala'=>'Kurunegala',
	'Mannar'=>'Mannar',
	'Matale'=>'Matale',
	'Matara'=>'Matara',
	'Moneragala'=>'Moneragala',
	'Mullaitivu'=>'Mullaitivu',
	'Nuwara Eliya'=>'Nuwara Eliya',
	'Polonnaruwa'=>'Polonnaruwa',
	'Puttalam'=>'Puttalam',
	'Ratnapura'=>'Ratnapura',
	'Trincomalee'=>'Trincomalee',
	'Vavuniya'=>'Vavuniya'
	), $member->district, array('class'=>'form-control')) }}
<br>
{{ Form::label('Hospital')}}
{{ Form::text('hospital', $member->hospital, array('class'=>'form-control')) }}
<br>
{{ Form::label('Address')}}
{{ Form::text('address', $member->address, array('class'=>'form-control')) }}
<br>
{{ Form::label('Telephone No. 1')}}
{{ Form::text('tp1', $member->tp1, array('class'=>'form-control')) }}
<br>
{{ Form::label('Telephone No. 2')}}
{{ Form::text('tp2', $member->tp2, array('class'=>'form-control')) }}
<br>
{{ Form::label('Telephone No. 3')}}
{{ Form::text('tp3', $member->tp3, array('class'=>'form-control')) }}
<br>
<div class="form-group">
{{ Form::label('Profile Picture')}}
{{ Form::file('pro_pic_upload', array('id'=>'pro_pic_upload')) }}
{{ Form::hidden('pro_pic', null, array('id'=>'pro_pic'))}}
</div>
<div id = "profile_pic" class="form-group"></div>
{{ Form::label('Cover Photo')}}
{{ Form::file('cover_pic_upload', array('id'=>'cover_pic_upload')) }}
{{ Form::hidden('cover_pic', null, array('id'=>'cover_pic'))}}
<br>
<div id = "cov_pic"></div>
{{ Form::label('Description')}}
{{ Form::textarea('description', $member->description, array('class'=>'form-control')) }}
<br>
{{ Form::label('Qualifications')}}
{{ Form::text('qualifications', $member->qualifications, array('class'=>'form-control')) }}
<br>
{{ Form::label('Experience')}}
{{ Form::text('experience', $member->experience, array('class'=>'form-control')) }}
<br>

{{ Form::submit('Submit', array('class'=>'btn btn-default'))}}

{{ Form::close() }}

@if($errors->has())
	<div>
		<p> The following errors has occurred:</p>

		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<script type="text/javascript" src="{{url()}}/js/admin/pictures.js"></script>
<script type="text/javascript" src="{{url()}}/js/admin/member.js"></script>
<script type="text/javascript">

	window.onload = function(){

		var pro_pic = document.createElement("IMG");
		pro_pic.src = "{{ URL::to('/')."/uploads/member/profile/".$member->profile_picture }}";
		pro_pic.height = 200;
		document.getElementById("profile_pic").appendChild(pro_pic);

		var cover_pic = document.createElement("IMG");
		cover_pic.src = "{{ URL::to('/')."/uploads/member/cover/".$member->cover_picture }}";
		cover_pic.height = 200;
		document.getElementById("cov_pic").appendChild(cover_pic);
}
</script>

@stop