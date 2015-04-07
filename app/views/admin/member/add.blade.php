@extends('admin.layouts.main')

@section('content')

@if(Session::has('message'))

	<div class="alert alert-danger">{{ Session::get('message') }}</div>

@endif
@if($errors->has())
	<div class="alert alert-danger">
		<p> The following errors has occurred:</p>

		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
{{ Form::open(array('url'=>'admin/member/create', 'files'=>true)) }}

{{ Form::label('Name')}}
{{ Form::text('name', '', array('class'=>'form-control')) }}
<br>
{{ Form::label('Email')}}
{{ Form::email('email', '', array('class'=>'form-control')) }}
<br>
{{ Form::label('Password')}}
{{ Form::password('password', array('class'=>'form-control')) }}
<br>
{{ Form::label('User Type')}}
{{ Form::select('type', array('1'=>'Super Admin', '2'=>'Admin', '3'=>'Member'),null, array('class'=>'form-control')) }}
<br>
{{ Form::label('NIC')}}
{{ Form::text('nic', '', array('class'=>'form-control')) }}
<br>
{{ Form::label('Concil Registration No')}}
{{ Form::text('council_reg_no', '', array('class'=>'form-control')) }}
<br>
{{ Form::label('Gender')}}
{{ Form::radio('sex', '0') }} Male {{ Form::radio('sex', '1') }} Female
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
	),null, array('class'=>'form-control')) }}
<br>
{{ Form::label('Hospital')}}
{{ Form::text('hospital', '', array('class'=>'form-control')) }}
<br>
{{ Form::label('Address')}}
{{ Form::text('address', '', array('class'=>'form-control')) }}
<br>
{{ Form::label('Telephone No. 1')}}
{{ Form::text('tp1', '', array('class'=>'form-control')) }}
<br>
{{ Form::label('Telephone No. 2')}}
{{ Form::text('tp2', '', array('class'=>'form-control')) }}
<br>
{{ Form::label('Telephone No. 3')}}
{{ Form::text('tp3', '', array('class'=>'form-control')) }}
<div class="form-group">
{{ Form::label('Profile Picture')}}
{{ Form::file('pro_pic_upload', array('id'=>'pro_pic_upload', 'accept'=>'image/jpeg')) }}
{{ Form::hidden('pro_pic', null, array('id'=>'pro_pic'))}}
</div>

<div id = "profile_pic" class="form-group"></div>
{{ Form::label('Cover Photo')}}
{{ Form::file('cover_pic_upload', array('id'=>'cover_pic_upload', 'accept'=>'image/jpeg')) }}
{{ Form::hidden('cover_pic', null, array('id'=>'cover_pic'))}}
<br>
<div id = "cov_pic"></div>
{{ Form::label('Description')}}
{{ Form::textarea('description', '', array('class'=>'form-control')) }}
<br>
{{ Form::label('Qualifications')}}
{{ Form::text('qualifications', '', array('class'=>'form-control')) }}
<br>
{{ Form::label('Experience')}}
{{ Form::text('experience', '', array('class'=>'form-control')) }}
<br>

{{ Form::submit('Submit', array('class'=>'btn btn-default'))}}

{{ Form::close() }}


<script type="text/javascript" src="{{url()}}/js/admin/pictures.js"></script>
<script type="text/javascript" src="{{url()}}/js/admin/member.js"></script>

@stop