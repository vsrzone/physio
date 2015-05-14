<div><h3>{{$exam->title}}</h3></div>
<div> <p>{{$exam->description}}</p> </div>
<div> <p>Duration: {{($exam->duration/60).'Hours only'}} </p> </div>
<div id="timer"></div>
<div id="clock"></div>

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

{{ Form::submit('Submit Answers') }}

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
	            alert('Time out');
	            window.location = '{{url()}}/members/exams';
	        }
	    }, 1000);
	}

	window.onload = function () {
	    var minutes = {{$exam->duration}} * 60,
	        display = document.querySelector('#timer');
	    startTimer(minutes, display);
	};

</script>