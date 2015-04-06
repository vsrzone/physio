@extends('admin.layouts.main')

@section('content')

<div >
	{{ Form::open(array('url'=>'admin/image/destroy')) }}
	<div >
		<div>		
		@foreach($images as $image)
			<div align="center">
				<img height="100" src="{{ URL::to('/')."/uploads/images/".$image->name }}" />
				<br>{{ Form::checkbox('imgStatus[]', $image->id) }}	
			</div>			
		@endforeach
		</div>
	</div>
</div>
<div>
	{{ Form::submit('Delete Selected Images', array()) }}
	{{ Form::close() }}
</div>	

</div>
@stop