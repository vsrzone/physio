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

<div>News Category: {{ Form::select('category_id', $categories, $news->category_id, array('class'=>'form-control')) }} </div>
{{ Form::hidden('id', $news->id) }}
<div>News date: {{ Form::text('date', $news->news_date, array('class'=>'form-control')) }} </div>
<div> News Title: {{ Form::text('title', $news->title, array('class'=>'form-control')) }} </div>
<div>Content: {{ Form::textarea('content', $news->content, array('class'=>'form-control')) }} </div>
<div> {{ Form::submit('Save changes', array('class'=>'btn btn-default')) }} 

{{ Form::close() }}
{{ Form::open(array('url'=>'admin/image/create', 'method'=>'GET', 'style'=>'display:inline')) }}
{{ Form::hidden('id', $news->id) }}
 {{ Form::submit('Add more images', array('class'=>'btn btn-outline btn-success')) }} 
{{ Form::close() }}
{{ Form::open(array('url'=>'admin/image/edit', 'method'=>'GET', 'style'=>'display:inline')) }}
{{ Form::hidden('id', $news->id) }}
 {{ Form::submit('Delete existing images', array('class'=>'btn btn-outline btn-warning')) }}
</div>
{{ Form::close() }}

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>
@stop