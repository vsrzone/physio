<div><h3>{{$essay->title}}</h3></div>
<div> <p>{{$essay->description}}</p> </div>
<div> <p>Duration: {{($essay->duration/60).'Hours only'}} </p> </div>
<div id="timer"></div>
<div id="clock"></div>

<input type = "hidden" id = "paper_id" value = "{{$essay->id}}">
<div data-bind="foreach: answerArray">
	<h3 data-bind="text: question"></h3>
	<textarea rows="6" cols="80" data-bind="value: answer"></textarea>
	</br>
</div>
<div>
	<button onclick = "sendRequestToServerPost()">Submit Answers</button>
</div>

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

	// send requests to server every 5 minutes

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

				xmlhttp.open("POST","{{url()}}/members/essay/pooling",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send(headers);
			}
		, 5000);
	}


	window.onload = function () {
	    var minutes = {{$essay->duration}} * 60,
	    display = document.querySelector('#timer');
	    startTimer(minutes, display);
	    loadPaper();
	    // pooling();
	};

	//loading paper
	var loadPaper = function(){
		paper = {{$essay->paper}};
		paper = paper.questions;
		console.log(paper)
		for (var j = 0; j <= paper.length - 1; j++) {
		
			var question = new Question();
			question.question(paper[j].question);
			question.answer('');
			question.marks(paper[j].marks);

			questions.answerArray.push(question);
		};
	}
	
	//question class
	var Question = function(){
		var self = this;

		this.question = ko.observable();
		this.answer = ko.observable(' ');
		this.marks = ko.observable();
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
		console.log(answers);
		var paper_id = document.getElementById('paper_id').value;

		var headers = 'answers=' + answers + '&paper_id=' + paper_id;

		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
	    		if(xmlhttp.responseText === 'success') {
	    			window.location = "{{url()}}/members/essays";
	    		}
	    	}
	  	}

		xmlhttp.open("POST","{{url()}}/members/essay/markresults",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(headers);
	}
</script>