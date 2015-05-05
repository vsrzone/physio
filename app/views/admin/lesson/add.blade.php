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
<div>Content: {{ Form::textarea('content') }}</div>
<div> {{ Form::submit('Add Lesson', array('class'=>'btn btn-default')) }} </div>
{{ Form::close() }}

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">

	tinymce.init({
	    selector: "textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
        	"insertdatetime media table contextmenu paste"
	    ],
	    media_dimensions: false,
    	image_dimensions: false
	 });

</script>
@stop