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
{{ Form::open(array('url'=>'admin/lesson/update')) }}
{{ Form::hidden('id', $lesson->id) }}
<div> Lesson topic: {{ Form::text('topic', $lesson->topic, array('class'=>'form-control', 'required')) }} </div>
<div>Content: {{ Form::textarea('content', $lesson->content, array('id'=>'tiny')) }}</div>
<div> {{ Form::submit('Save changes', array('class'=>'btn btn-default')) }} </div>
{{ Form::close() }}

<script type="text/javascript" src="{{url()}}/js/admin/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	
	tinymce.PluginManager.load('advimagescale', '{{url()}}/js/admin/tinymce/js/tinymce/plugins/advimagescale/editor_plugin.js');
	tinymce.init({
	    selector: "textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
        	"insertdatetime media table contextmenu paste"
	    ],
	    media_dimensions: false,
    	image_dimensions: false,
	 });
</script>
@stop