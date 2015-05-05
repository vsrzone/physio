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
{{ Form::open(array('url'=>'admin/lesson/create')) }}
<div> Lesson topic: {{ Form::text('topic', '', array('class'=>'form-control', 'required')) }} </div>
<div>Content: {{ Form::textarea('content', '', array('required', 'class'=>'form-control')) }}</div>
<div> {{ Form::submit('Add Category', array('class'=>'btn btn-default')) }} </div>
{{ Form::close() }}

@stop