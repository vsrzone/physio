@extends('admin.layouts.main')
@section('content')
@if(Session::has('message'))
	<div> {{ Session::get('message') }} </div>
@endif
@if($errors->has())
	<div>
	<ul>
		@foreach($errors->all() as $error)			
				<li> {{ $error }} </li>			
		@endforeach
	</ul>
</div>
@endif
{{ Form::open(array('url'=>'admin/news/create')) }}
<div>Activate news: {{ Form::checkbox('active') }} </div>
<div>Members only: {{ Form::checkbox('member') }} </div>
<div>News Category: {{ Form::select('category_id', $categories) }} </div>
<div>News date: {{ Form::text('date') }} </div>
<div> News Title: {{ Form::text('title') }} </div>
<div>Content: {{ Form::textarea('content') }} </div>
<div> {{ Form::submit('Add News') }} </div>
{{ Form::close() }}

@stop