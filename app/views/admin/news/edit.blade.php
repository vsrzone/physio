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
{{ Form::open(array('url'=>'admin/news/update')) }}
@if($news->active)
	<div>Activate news: {{ Form::checkbox('active','1', array('checked')) }} </div>
@else
	<div>Activate news: {{ Form::checkbox('active') }} </div>
@endif
@if($news->members_only)
	<div>Members only: {{ Form::checkbox('member','1', array('checked')) }} </div>
@else
	<div>Members only: {{ Form::checkbox('member') }} </div>
@endif

<div>News Category: {{ Form::select('category_id', $categories, $news->category_id) }} </div>
{{ Form::hidden('id', $news->id) }}
<div>News date: {{ Form::text('date', $news->news_date) }} </div>
<div> News Title: {{ Form::text('title', $news->title) }} </div>
<div>Content: {{ Form::textarea('content', $news->content) }} </div>
<div> {{ Form::submit('Save changes') }} </div>
{{ Form::close() }}

@stop