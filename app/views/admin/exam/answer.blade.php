@foreach($answers as $an)
	@foreach($an as $q)
		<ul>
			<li><h2 style = "display: inline">{{$q['question']}}</h2><span style = "color:red"> (Marks - {{$q['marks']}})</span></li>
			<ul>
				<li><h4 style = "color:green">{{$q['answer']}}</h4></li>
			</ul>
		</ul>
	@endforeach
@endforeach