@extends('layouts.main')

@section('content')
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
			<img src="{{ url() }}/images/slider5.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
			</li>
		</ul>
	</div>
</div>

<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12" id="members-wrappers">
			<div class="well">			
				@foreach($essays as $essay)
				{{ Form::open(array('url'=>'members/essay')) }}
				<div class="panel panel-default">					
					<div class="panel-heading">{{$essay->title}}</div>
					<div class="panel-body">{{$essay->description}}</div> 
					{{ Form::hidden('id', $essay->id) }}
					{{ Form::submit('Try essay') }}  					            
				</div>
				{{ Form::close() }}     
				@endforeach	
		</div>
	</div>
</div>

@stop