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
<div>News Category: {{ Form::select('category_id', $categories, $news->category_id) }} </div>
<div>News date: {{ Form::text('date', $news->news_date) }} </div>
<div> News Title: {{ Form::text('title', $news->title) }} </div>
<div>Content: {{ Form::textarea('content', $news->content) }} </div>
<div> {{ Form::submit('Save changes') }} </div>
{{ Form::close() }}

@stop