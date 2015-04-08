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
{{ Form::open(array('url'=>'admin/news/create', 'files'=>true)) }}
<div>Activate news: {{ Form::checkbox('active','', false, array('id'=> 'active')) }} </div>
<div>Members only: {{ Form::checkbox('member','',false, array('id'=> 'member')) }} </div>
<div>News Category: {{ Form::select('category_id', $categories,null, array('id'=>'category_id', 'class'=>'form-control')) }} </div>
<div>News date: {{ Form::text('date', '', array('id'=>'date', 'class'=>'form-control')) }} </div>
<div> News Title: {{ Form::text('title', '', array('id'=>'title', 'class'=>'form-control')) }} </div>
<div>Content: {{ Form::textarea('content','', array('id'=>'content', 'class'=>'form-control')) }} </div>

<div> {{ Form::file('files', array('id'=>'news_images', 'multiple', 'accept'=>'image/jpeg')) }} </div>
<div id="displayArea1"></div>
<div> {{ Form::button('Add News', array('id'=>'add_news', 'class'=>'btn btn-default')) }} </div>
{{ Form::close() }}

<script type="text/javascript" src="{{url()}}/js/admin/photos.js"></script>
<script type="text/javascript" src="{{url()}}/js/admin/news.js"></script>

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>

@stop