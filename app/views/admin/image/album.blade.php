
@extends('admin.layouts.main')

@section('content')

<div class="flex-container">
	<div class="row">
		<div class="col-xs-12">
			
			<div class="panel panel-green">
				<div class="panel-heading">Add Images to Album</div>
				<div class="panel-body">
				@foreach($images as $image)	
						<img height="100" src="{{ URL::to('/')."/uploads/images/".$image->name }}">	
				@endforeach
				</div>
				<div class="panel-footer">
					{{ Form::open(array('url'=>'admin/image/album', 'files'=>true)) }}	
					{{ Form::hidden('pro_id', $news_id, array('id'=>'album_data')) }}
					
					
					<div class="form-group">
						{{ Form::label('Add Images') }}
						{{ Form::file('files', array('id'=>'news_images', 'multiple','accept'=>'image/jpeg')) }}
					</div>
					<div class="flex-container">
						<div class="row">							
						<div id="displayArea2"></div>
						<div id="displayArea1" class="col-xs-12"></div>	
						</div>	
					</div>					
					{{ Form::button('Add Images', array('id'=>'add_news', 'class'=>'btn btn-default')) }}</div>				
					{{ Form::close() }}
				</div>
			</div>			
		</div>
	</div>
</div>

<script type="text/javascript" src="{{url()}}/js/admin/photos.js"></script>
<script type="text/javascript" src="{{url()}}/js/admin/image.js"></script>

@stop