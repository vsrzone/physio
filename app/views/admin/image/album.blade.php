@extends('admin.layouts.main')

@section('content')			
				
<div >
@foreach($images as $image)	
		<img height="100" src="{{ URL::to('/')."/uploads/images/".$image->name }}">	
@endforeach
</div>
<div>
	{{ Form::open(array('url'=>'admin/image/album', 'files'=>true)) }}
	{{ Form::button('Add Images', array('id'=>'add_news')) }}
	{{ Form::hidden('pro_id', $news_id, array('id'=>'album_data')) }}
	<div >
		{{ Form::label('Add Images') }}
		{{ Form::file('files', array('id'=>'news_images', 'multiple','accept'=>'image/jpeg')) }}	
	</div>
	<div >
		<div>							
		<div id="displayArea2"></div>
		<div id="displayArea1"></div>	
		</div>	
	</div>					
	{{ Form::close() }}
</div>			

<script type="text/javascript" src="{{url()}}/js/admin/photos.js"></script>
<script type="text/javascript" src="{{url()}}/js/admin/image.js"></script>

@stop