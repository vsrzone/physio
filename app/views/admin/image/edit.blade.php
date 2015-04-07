
@extends('admin.layouts.main')

@section('content')
<div class="flex-container">
	<div class="row">
		<div class="col-xs-12">
			
			<div class="panel panel-yellow">
				<div class="panel-heading">Remove images form Album</div>
				<div class="panel-body">
					{{ Form::open(array('url'=>'admin/image/destroy')) }}
					<div class="flex-container">
						<div class="row">
						<?php $count = 1; ?>
						@foreach($images as $image)
							<div align="center" class="col-xs-6 col-sm-4 col-md-2">
								<img width="100%" src="{{ URL::to('/')."/uploads/images/".$image->name }}" />
								<br>{{ Form::checkbox('imgStatus[]', $image->id) }}		
							</div>	
							<?php
							if(!($count%6)){
								echo '<div class="clearfix visible-md-block"></div>';
							}elseif(!($count%3)){
								echo '<div class="clearfix visible-sm-block"></div>';
							}
							elseif(!($count%2)){
								echo '<div class="clearfix visible-xs-block"></div>';
							}
								$count++;
							?>					
						@endforeach
						</div>
					</div>
				</div>
				<div class="panel-footer">
					{{ Form::submit('Delete Selected Images', array('class'=>'btn btn-default')) }}
					{{ Form::close() }}
				</div>	
			</div>
		</div>
	</div>
</div>
<div>
</div>
@stop