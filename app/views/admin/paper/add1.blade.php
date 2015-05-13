@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif
@if($errors->has())
	<div class="alert alert-danger">
	<ul>
		@foreach($errors->all() as $error)			
				<li> {{ $error }} </li>			
		@endforeach
	</ul>
</div>
@endif

{{ Form::open(array('url'=>'admin/paper/create')) }}
<div> {{ Form::label('', 'Title') }}: {{ Form::text('title', '', array('class'=>'form-control')) }} </div>
<div> {{ Form::label('', 'Description') }}: {{ Form::textarea('description', '', array('class'=>'form-control')) }} </div>
<div> {{ Form::label('', 'Paper duration') }}: {{ Form::text('duration_hr', '', array('class'=>'form-control', 'placeholder'=>'Hours')) }} {{ Form::text('duration_min', '', array('class'=>'form-control', 'placeholder'=>'minutes')) }} </div>
<div id="questions_container">
	
</div>
<div> {{ Form::button('Add new question', array('id'=>'add_question')) }} </div>
<div> {{ Form::submit('Add Paper', array('class'=>'btn btn-default', 'id'=>'submit')) }} </div>
{{ Form::close() }}

<script type="text/javascript">
var question = ["fsgfd"];

document.getElementById('add_question').onclick = function(){
	addQuestion();
}

var addQuestion = function(){
	var i = 1;//question.length;

	var question_container = document.createElement("DIV");
	question_container.id = "div"+i;
	var divquestion = document.createElement("DIV");
	divquestion.id = "divquestion"+i;
	var divoption1 = document.createElement("DIV");
	divoption1.id = "divoption1"+i;
	var divoption2 = document.createElement("DIV");
	divoption2.id = "divoption2"+i;
	var divoption3 = document.createElement("DIV");
	divoption3.id = "divoption3"+i;
	var divoption4 = document.createElement("DIV");
	divoption4.id = "divoption4"+i;
	var divanswer = document.createElement("DIV");
	divanswer.id = "divanswer"+i;


	var option1 = document.createElement('input'); 
	option1.type = "text";
	option1.id = "option1"+i;
	option1.className = "form-control";
	var option2 = document.createElement('input'); 
	option2.type = "text";
	option2.id = "option2"+i;
	option2.className = "form-control";
	var option3 = document.createElement('input'); 
	option3.type = "text";
	option3.id = "option3"+i;
	option3.className = "form-control";
	var option4 = document.createElement('input'); 
	option4.type = "text";
	option4.id = "option4"+i;
	option4.className = "form-control";
	var question = document.createElement('textarea'); 
	question.id = "question"+i;
	question.className = "form-control";
	var answer = document.createElement('select'); 
	answer.id = "answer"+i;
	answer.className = "form-control";

	var opt1 = document.createElement('option');
	opt1.value = "Option 1";
	var opt1 = document.createElement('option');
	opt1.value = "Option 1";
	var opt1 = document.createElement('option');
	opt1.value = "Option 1";
	var opt1 = document.createElement('option');
	opt1.value = "Option 1";

	var txtquestion = document.createTextNode("Question");
	var txtoption1 = document.createTextNode("Option 1");
	var txtoption2 = document.createTextNode("Option 2");
	var txtoption3 = document.createTextNode("Option 3");
	var txtoption4 = document.createTextNode("Option 4");
	var txtanswer = document.createTextNode("Answer");

	
	divquestion.appendChild(txtquestion);
	divoption1.appendChild(txtoption1);
	divoption2.appendChild(txtoption2);
	divoption3.appendChild(txtoption3);
	divoption4.appendChild(txtoption4);
	divanswer.appendChild(txtanswer);

	divquestion.appendChild(question);
	divoption1.appendChild(option1);
	divoption2.appendChild(option2);
	divoption3.appendChild(option3);
	divoption4.appendChild(option4);
	divanswer.appendChild(answer);

	question_container.appendChild(divquestion);
	question_container.appendChild(divoption1);
	question_container.appendChild(divoption2);
	question_container.appendChild(divoption3);
	question_container.appendChild(divoption4);
	question_container.appendChild(divanswer);

	questions_container.appendChild(question_container);	
}
</script>
@stop