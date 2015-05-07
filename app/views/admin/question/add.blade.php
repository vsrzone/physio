@extends('admin.layouts.main')

@section('content')

<form id="newQuestion">
	<input type="text" data-bind="value: question">
	<div data-bind="foreach: options">
		<input data-bind="value: text">
	</div>
	<button data-bind="click: addOption">add option</button>
	<button data-bind="click: saveQuestion">save question</button>
</form>

<div id="questions-container" data-bind="foreach: questions">
	<div>
		<h3 data-bind="text: question"></h4>
		<div data-bind="foreach: options">
			<h5 data-bind="text: text"></h5>
		</div>
	</div>
</div>


<script type="text/javascript" src="{{url()}}/js/knockout-3.3.0.js"></script>
<script type="text/javascript">
	var Option = function(){
		var self = this;

		this.text = '';
		this.setAnswer = false;
	}

	var Question = function(){
		var self = this;

		this.question = ko.observable();
		this.options = ko.observableArray();
	}

	var savedQuestionsView = function(){
		var self = this;
		
		this.questions = ko.observableArray();
	};

	var currentQuestionInput = function(){
		var self = this;

		this.question = ko.observable('');
		this.options = ko.observableArray([new Option()]);

		this.addOption = function(){
			self.options.push(new Option());
		}

		this.saveQuestion = function(){
			var question = new Question();
			question.question = self.question();
			question.options = self.options();

			savedQuestions.questions.push(question);
		}
	}

	var currQuestion = new currentQuestionInput();
	var savedQuestions = new savedQuestionsView();

	ko.applyBindings(currQuestion, document.getElementById('newQuestion'));
	ko.applyBindings(savedQuestions, document.getElementById('questions-container'));
</script>
@stop