@extends('admin.layouts.main')

@section('content')

{{ Form::open(array('url'=>'admin/user/update')) }}

{{ Form::label('Username')}}
{{ Form::text('name', $user->name) }}
<br>
{{ Form::label('Password')}}
{{ Form::password('password') }}
<br>
{{ Form::label('User Type')}}
{{ Form::select('type', array('1'=>'Super Admin', '2'=>'Admin'), $user->type) }}
<br>
{{ Form::hidden('id', $user->id)}}
{{ Form::submit('Submit')}}

{{ Form::close() }}

@stop