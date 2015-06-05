@extends('layouts.main')
<?php 
	$page = 'exams';
?>
@section('content')
<div id="banner-container">
	<ul id="main-slider" class="">
		<li style="background-image:url({{ url() }}/images/slider/01.jpg)">
			<p>"Looking after your health today gives you a better hope for tomorrow."</p>
		</li>
	</ul>	
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">	
		<div  class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="loginModelLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" id="login-area">
						@if(!$type)
							<div>
								Are you sure you want to get registered for the selected examination?

								{{ Form::open(array('url'=>'members/exam/register')) }}
								{{ Form::hidden('id', Input::get('id')) }}
								{{ Form::submit('Yes', array('class'=>'btn')) }}
								{{ Form::close() }}
								{{ Form::open(array('url'=>'members/exams', 'method'=>'GET')) }}
								{{ Form::submit('No', array('class'=>'btn')) }}
								{{ Form::close() }}
							</div>
						@elseif($type->state == 1)
							<div>
								You have registered for the selected examination.

								
								{{ Form::open(array('url'=>'members/exams', 'method'=>'GET')) }}
								{{ Form::submit('Back', array('class'=>'btn')) }}
								{{ Form::close() }}
							</div>
						@elseif($type->state == 2)
							<div>
								Are you sure you want start answering the selected examination?

								{{ Form::open(array('url'=>'members/exam/answer')) }}
								{{ Form::hidden('id', Input::get('id')) }}
								{{ Form::submit('Yes', array('class'=>'btn')) }}
								{{ Form::close() }}
								{{ Form::open(array('url'=>'members/exams', 'method'=>'GET')) }}
								{{ Form::submit('No', array('class'=>'btn')) }}
								{{ Form::close() }}
							</div>
						@elseif($type->state == 3)
							<div>
								You have sat for the selected examination.

								
								{{ Form::open(array('url'=>'members/exams', 'method'=>'GET')) }}
								{{ Form::submit('Back', array('class'=>'btn')) }}
								{{ Form::close() }}
							</div>
						@elseif($type->state == 4 || $type->state == 5)
							<div>
								Are you sure you want to get re-registered for the selected examination?

								{{ Form::open(array('url'=>'members/exams/register')) }}
								{{ Form::hidden('id', Input::get('id')) }}
								{{ Form::submit('Yes', array('class'=>'btn')) }}
								{{ Form::close() }}
								{{ Form::open(array('url'=>'members/exams', 'method'=>'GET')) }}
								{{ Form::submit('No', array('class'=>'btn')) }}
								{{ Form::close() }}
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
	
	$(window).load(function(){
		$('#confirm-modal').modal({backdrop: 'static'});  
        $('#confirm-modal').modal('show');
    });
</script>
@stop