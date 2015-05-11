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
	<div data-bind="css : { edit: edit() != false }">
		<input type="text" data-bind="value: question" placeholder="Add question" class="form-control unedit">
		<div data-bind="foreach: options">
			<input  type="checkbox" data-bind="value: text" class="unedit" /><input data-bind="value: text" placeholder="Add option" class="form-control unedit">
			<a class="unedit" href="#" data-bind="click: $parent.removeOption">X</a>
		</div> 

		<button data-bind="click: addOption">Add option</button>
		<button data-bind="click: saveQuestion">Save question</button>
	</div>
</form>

<div id="questions-container" data-bind="foreach: questions">
	
	<div data-bind="css : { edit: edit() != false }">
		<h3 data-bind="text: question" class="unedit"></h3>
		<input data-bind='value: question, valueUpdate: "afterkeydown"' class="editable"/>	
		
		<h4 data-bind='value: question' class="editable"></h4>	
		<div data-bind="foreach: options">
			<h5 data-bind="text: text" class="unedit"></h5>
		</div>
		<div data-bind="foreach: options">
			<input data-bind="value: text" class="editable" type="text"/>
			<a class="editable" href="#" data-bind="click: $parent.removeOption">X</a>
		</div>
		<a href="#" data-bind="click: $parent.removeSavedQuestion" class="unedit">Remove</a>
		<a href="#" data-bind="click: $parent.saveEditedQuestion" class="editable">Save</a>
		<a href="#" data-bind="click: $parent.editSavedQuestion" class="unedit">Edit</a>
	</div>
</div>
 <button id="submit">Add paper</button>

<script type="text/javascript" src="{{url()}}/js/knockout-3.3.0.js"></script>
<script type="text/javascript">
	var Option = function(){
		var self = this;

		this.text = ko.observable('');
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
			currQuestion.edit(!currQuestion.edit());
		
		}

		this.saveEditedQuestion = function(){
		
			this.edit(!this.edit());
			currQuestion.edit(!currQuestion.edit());
			self.refresh();			
		}

		this.removeOption = function(){
			if(this.options().length > 1){
				this.options.remove(this);
			}
				
		}

		self.refresh = function(){
		    var data = self.array().slice(0);
		    self.questions([]);
		    self.questions(data);
		};
	};

	var currentQuestionInput = function(){
		var self = this;

		this.question = ko.observable('');
		this.options = ko.observableArray([new Option()]);

		this.edit = ko.observable(false);

		this.notEdit = ko.computed(function(){
			return !self.edit();
		}, this);

		this.addOption = function(){
			self.options.push(new Option());
		}

		this.saveQuestion = function(){
			var question = new Question();
			question.question(self.question());
		
			self.options().forEach(function(e){ 
				option = new Option()
				option.text(e.text());
				question.options.push(option);
			});

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