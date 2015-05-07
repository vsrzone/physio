@extends('admin.layouts.main')
@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif
@if($errors->has())
	<div class="alert alert-danger">
	<ul>
		@foreach($errors->all() as $error)			
				<li> {{ $error }} </li>			
		@endforeach
	</ul>
</div>
@endif
{{ Form::open(array('url'=>'admin/lesson/destroyfiles')) }}
{{ Form::hidden('lesson_id', $lesson_id, array('id'=> 'lesson_id')) }}

@foreach($attaches as $attach)
	<div> {{ $attach->title }} {{ Form::checkbox('files[]', $attach->id) }}</div>
@endforeach

<div id="file_upload"></div>

<div> {{ Form::submit('Remove Files', array('class'=>'btn btn-default', 'id'=>'submit')) }} </div>

{{ Form::close() }}

@stop