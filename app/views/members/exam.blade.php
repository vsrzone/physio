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
				<div class="panel-group" id="accordition">
					@foreach($exams as $exam)
					<div class="panel panel-default">
						<div class="panel-heading">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
								{{$exam->title}}
							</a>
						</div>
						<div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">{{$exam->description}}</div>
                        </div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

@stop