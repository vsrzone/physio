<?php  
	$page = 'learn';
?>
@extends('layouts.main')
<?php  
	$page = 'learn';
?>
@section('content')
<div id="banner-container">
		<ul id="main-slider" class="">
			<li style="background-image:url({{ url() }}/images/slider/01.jpg)">
				<p>"Looking after your health today gives you a better hope for tomorrow."</p>
			</li>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12" id="members-wrappers">
			<h1>{{$lesson->topic}}</h1>
			<p>
				@if($lesson->content)
					<?php

						$new_iframe_tag = str_replace("<iframe", "<iframe id = \"tinymce_vid\"", $lesson->content);
						if($new_iframe_tag) {
							$new_img_tag = str_replace("<img", "<img id = \"tinymce_img\"", $new_iframe_tag);
						} else {
							$new_img_tag =  str_replace("<img", "<img id = \"tinymce_img\"", $lesson->content);
						}
						
						echo $new_img_tag;
					?>
				@endif
			</p>
			@if($attachments)
				<h4>Downloads</h4>
			@endif
			
			@foreach ($attachments as $attachment)
				<a href="{{url()}}/uploads/files/{{$attachment->file}}" download>{{$attachment->title}}</a><br/>
			@endforeach
			<hr>
		</div>
	</div>
</div>

<style type="text/css">

#tinymce_vid {
	width: 640;
	height: 480;
}
</style>


<script type="text/javascript">

	var count = document.all("tinymce_img").length;

	for (i=0; i<count; i++) {

	 	var img_height = document.all("tinymce_img",i).height;
	 	var img_width = document.all("tinymce_img",i).width;

	 	if(document.all("tinymce_img",i).height >= document.all("tinymce_img",i).width) {
	 		var ratio = 600/img_height;

	 		document.all("tinymce_img",i).height = 600;
	 		document.all("tinymce_img",i).width = img_width*ratio;
	  	} else {
	  		var ratio = 600/img_width;

	  		document.all("tinymce_img",i).width =600;
	 		document.all("tinymce_img",i).height = img_height*ratio;
	  	}
	}
</script>
@stop