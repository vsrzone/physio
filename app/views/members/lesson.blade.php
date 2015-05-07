@extends('layouts.main')

@section('content')
<style type="text/css"></style>
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
				<img src="{{ url() }}/images/slider5.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
				<p>To enjoy the glow of good health, you must exercise</p>
			</li>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12" id="members-wrappers">
				@foreach($lessons as $lesson)
					<p>{{$lesson->topic}}</p>
					<p>
						@if($lesson->content)
							<?php

								$new_iframe_tag = str_replace("<iframe", "<iframe id = \"tinymce_vid\"", $lesson->content);
								if($new_iframe_tag) {
									$new_img_tag = str_replace("<img", "<img id = \"tinymce_img\"", $new_iframe_tag);
								} else {
									$new_img_tag =  str_replace("<img", "<img id = \"tinymce_img\"", $$lesson->content);
								}
								
								echo $new_img_tag;
							?>
						@endif
					</p>
					<hr>
				@endforeach
		</div>
		{{ $lessons->links() }}
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