@foreach($answers as $an)
	@foreach($an as $q)
		<ul>
			<li><h2 style = "display: inline">{{$q['question']}}</h2></li>
			<ul>
				<li><h4 style = "color:green">{{$q['answer']}}</h4></li>
			</ul>
		</ul>
	@endforeach
@endforeach
<input type = "text" id = "marks" />
<button id = "addMarks" onclick = "sendMarks()">Submit Marks</button>