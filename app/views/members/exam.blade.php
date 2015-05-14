<div><h3>{{$exam->title}}</h3></div>
<div> <p>{{$exam->description}}</p> </div>
<div> <p>Duration: {{($exam->duration/60).'Hours only'}} </p> </div>
<div id="timer"></div>
<div id="clock"></div>

{{ Form::open(array('url'=>'members/exam/markresults')) }}
{{ Form::hidden('paper_id', $exam->id) }}
@foreach(json_decode($exam->paper) as $obj)
	@foreach($obj as $cont)
		<p><b>{{'('.(array_search($cont, $obj)+1).') '. $cont->question }}</b></p>
		@foreach($cont->options as $option)
			<p>
				<input type="checkbox" />
				{{$option->text}}			
			</p>
		@endforeach
	@endforeach
@endforeach

{{ Form::submit('Submit Answers', array('id'=>'submit')) }}

<form>

	<p data-bind="text: question"></p>
	<div data-bind="foreach: optionArray">
		<input type="checkbox" data-bind="checked: state">
		<p data-bind="text: text"></p>
	</div>
	<div> <button type="submit">Submit Answers</button> </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{url()}}/js/knockout-3.3.0.js"></script>
<script type="text/javascript">

	var myVar=setInterval(function(){myTimer()},1000);

	function myTimer() {
	    var d = new Date();
	    document.getElementById("clock").innerHTML = d.toLocaleTimeString();
	}

	function startTimer(duration, display) {
	    var timer = duration;
	    var interval = setInterval(function () {
	        minutes = parseInt(timer / 60, 10);
	        seconds = parseInt(timer % 60, 10);

	        minutes = minutes < 10 ? "0" + minutes : minutes;
	        seconds = seconds < 10 ? "0" + seconds : seconds;

	        display.textContent = minutes + ":" + seconds;

	        if (--timer < 0) {
	        	window.clearTimeout(interval);
	        	sendRequestToServerPost();
	            alert('Time out');
	        }
	    }, 1000);
	}

	window.onload = function () {
	    var minutes = {{$exam->duration}} * 60,
	    display = document.querySelector('#timer');
	    startTimer(minutes, display);
	    loadPaper();
	};

	//loading paper
	var loadPaper = function(){
		paper = {{$exam->paper}};
		paper = paper.questions;
		for (var j = paper.length - 1; j >= 0; j--) {
		
			var question = new Question();
			question.question(paper[j].question);

			for (var i = paper[j].options.length - 1; i >= 0; i--) {
				
				if(!(paper[j].options[i].text.trim() == '')){
					option = new Option()
					option.text(paper[j].options[i].text);
					option.state(false);
					question.optionArray.push(option);
				}
			};	
			questions.answerArray.push(question);
		};
	}

	document.getElementById('submit').onclick = function(){
		sendRequestToServerPost();
	}

	//option class
	var Option = function(){
		var self = this;

		this.text = ko.observable('');
		this.state = ko.observable(false);
	}

	
	//question class
	var Question = function(){
		var self = this;

		this.question = ko.observable();
		this.optionArray = ko.observableArray();
	}

	//answers class
	var Answer = function(){
		var self = this;

		this.answerArray = ko.observableArray();
	}

	var questions = new Answer();
	
	ko.applyBindings(questions);

	function sendRequestToServerPost() {

		// send all the details to the server by an Ajax request

		var title = document.getElementById('title').value;
		var duration_hr = document.getElementById('duration_hr').value;
		var duration_min = document.getElementById('duartion_min').value;
		var rows = document.getElementsByName('examiners[]');
		var description = document.getElementById('description').value;
		var clean = cleanJson(savedQuestions);
		var paper = ko.toJSON(clean);
		var type = 2;

		var selectedRows = [];
	    for (var i = 0, l = rows.length; i < l; i++) {
	        if (rows[i].checked) {
	            selectedRows.push(rows[i].value);
	        }
	    }

	    if(title !== '') {

			if(duration_hr === '' && duration_min === '') {

				alert('You Should Enter a Duration');
			}
			else {

				if(!isNaN(duration_hr) && !isNaN(duration_min)) {

					var headers = 'title=' + title + '&examiners=' + selectedRows + '&description=' + description + '&hours=' + duration_hr + '&mins=' + duration_min + '&paper=' + paper + '&type=' + type;

					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{
				    		if(xmlhttp.responseText === 'success') {
				    			window.location = "{{url()}}/admin/paper/essay";
				    		}
				    	}
				  	}

					xmlhttp.open("POST","{{url()}}/members/exam/submit",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send(headers);
				} else {

					alert('You Should Enter a Valid Duration');
				}
			}
		} else {

			alert('You Should Enter a Title');
		}
	}

</script>