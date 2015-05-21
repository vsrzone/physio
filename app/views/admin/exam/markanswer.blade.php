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
{{Form::open(array('url'=>'admin/paper/essay/marking'))  }}
{{ Form::hidden('id', $id) }}
<input type = "text" name = "marks" />
<input type = "submit">Submit Marks
{{ Form::close() }}

