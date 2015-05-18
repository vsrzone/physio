<div><h3>{{$exam->title}}</h3></div>
<div> <p>{{$exam->description}}</p> </div>
<div> <p>Duration: {{($exam->duration/60).'Hours only'}} </p> </div>
<div id="timer"></div>
<div id="clock"></div>

<!-- {{ Form::open(array('url'=>'members/exam/markresults')) }}
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

{{ Form::submit('Submit Answers', array('id'=>'submit')) }} -->
	<input type = "hidden" id = "paper_id" value = "{{$exam->id}}">
	<div data-bind="foreach: answerArray">
		<h3 data-bind="text: question"></h3>
		<div data-bind="foreach: optionArray">
			<input type="checkbox" data-bind="checked: state">
			<p style = "display: inline" data-bind="text: text"></p>
			</br>
		</div>
	</div>
	<div> <button onclick = "sendRequestToServerPost()">Submit Answers</button> </div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
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

	var endPool;

	function pooling() {

		endPool = setInterval(
				function examState() {
					var paper_id = document.getElementById('paper_id').value;
					var headers = 'state=5&paper_id=' + paper_id;

					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{
				    		return xmlhttp.responseText;
				    	}
				  	}

					xmlhttp.open("POST","{{url()}}/members/exam/pooling",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send(headers);
				}
			, 5000);
	}


	window.onload = function () {
	    var minutes = {{$exam->duration}} * 60,
	    display = document.querySelector('#timer');
	    startTimer(minutes, display);
	    loadPaper();
	    pooling();
	};
	


	//loading paper
	var loadPaper = function(){
		paper = {{$exam->paper}};
		paper = paper.questions;
		console.log(paper)
		for (var j = 0; j <= paper.length - 1; j++) {
		
			var question = new Question();
			question.question(paper[j].question);

			for (var i = 0; i <= paper[j].options.length - 1; i++) {
				
				if(!(paper[j].options[i].text.trim() == '')){
					option = new Option();
					option.text(paper[j].options[i].text);
					option.state(false);
					question.optionArray.push(option);
				}
			};	
			questions.answerArray.push(question);
		};
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

		// var title = document.getElementById('title').value;
		clearInterval(endPool);
		var answers = ko.toJSON(questions);
		var paper_id = document.getElementById('paper_id').value;

		var headers = 'answers=' + answers + '&paper_id=' + paper_id;

		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
	    		if(xmlhttp.responseText === 'success') {
	    			window.location = "{{url()}}/members/exams";
	    		}
	    	}
	  	}

		xmlhttp.open("POST","{{url()}}/members/exam/markresults",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(headers);
	}

</script>