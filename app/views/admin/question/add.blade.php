@extends('admin.layouts.main')

@section('content')

<style type="text/css">
	.edit .unedit{
		display: none;
	}

	.editable{
		display: none;
	}

	.edit .editable{
		display: block;
	}
</style>

<form id="paper-container">
	<label>Paper title: </label> <input type="text" id="title" class="form-control" />
	<label>Duration: </label> <input type="text" id="duration_hr" placeholder="Hours" class="form-control" />
	<input type="text" id="duartion_min" placeholder="Minutes" class="form-control"class="form-control" />
	<label>Paper description</label><textarea id="description" class="form-control" ></textarea>
</form>
<form id="newQuestion">
	<input type="text" data-bind="value: question" placeholder="Add question" class="form-control">
	<div data-bind="foreach: options">
		<input type="checkbox" data-bind="value: text" /><input data-bind="value: text" placeholder="Add option" class="form-control">
		<a href="#" data-bind="click: $parent.removeOption">X</a>
	</div> 

	<button data-bind="click: addOption">Add option</button>
	<button data-bind="click: saveQuestion">Save question</button>
</form>

<div id="questions-container" data-bind="foreach: questions">
	<div data-bind="css : { edit: edit() != false }">
		<h3 data-bind="text: question" class="unedit"></h4>
		<input type="text" data-bind="value: question" class="editable"/>
		<div data-bind="foreach: options">
			<h5 data-bind="text: text" class="unedit"></h5>
		</div>
		<div data-bind="foreach: options">
			<input data-bind="value: text" class="editable" type="text"/>
		</div>
		<a href="#" data-bind="click: $parent.removeSavedQuestion">Remove</a>
		<a href="#" data-bind="click: $parent.editSavedQuestion">Edit</a>
	</div>
</div>
 <button id="submit">Add paper</button>

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

		this.edit = ko.observable(false);

		this.notEdit = ko.computed(function(){
			return !self.edit();
		}, this);
	}

	var savedQuestionsView = function(){
		var self = this;
		
		this.questions = ko.observableArray();

		this.removeSavedQuestion = function(){
			self.questions.remove(this);
		}

		this.editSavedQuestion = function(k,e){
			
			this.edit(!this.edit());
		}
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

		this.removeOption = function(){
			if(self.options().length > 1){
				self.options.remove(this);
			}
				
		}
	}

	var currQuestion = new currentQuestionInput();
	var savedQuestions = new savedQuestionsView();

	ko.applyBindings(currQuestion, document.getElementById('newQuestion'));
	ko.applyBindings(savedQuestions, document.getElementById('questions-container'));
</script>
@stop