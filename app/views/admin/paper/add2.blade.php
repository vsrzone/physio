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
		display: inline-block;
	}
	.add-question-option{
		width: 80%;
		display: inline-block;
		margin-top: 10px;
	}
</style>
<div class="col-xs-12">
	<form id="paper-container">
		<div class="row">
			<div class="form-group col-xs-6">
				<label>Paper title: </label> 
				<input type="text" id="title" class="form-control" />
			</div>
			<div class="form-group col-xs-6">
				<label class="col-xs-12">Duration: </label> 
				<div class="controls form-inline">
					<input type="text" id="duration_hr" placeholder="Hours" class="form-control col-xs-6" />
					<input type="text" id="duartion_min" placeholder="Minutes" class="form-control col-xs-6" />
				</div>
			</div>
			<div class="form-group col-xs-6">
				<label>Paper description</label>
				<textarea id="description" class="form-control" ></textarea>
			</div>
		</div>
	</form>
	<form id="newQuestion">
		<div data-bind="css : { edit: edit() != false }">
			<div class="panel panel-default unedit">
				<div class="panel-heading">Add new Question...</div>
				<div class="panel-body">
					<textarea id="question" data-bind="value: question" placeholder="Add question" class="form-control unedit"></textarea>
					<div data-bind="foreach: options">
						<div>
							<input  type="checkbox" data-bind="click: $parent.toggleCheckbox" class="unedit" />
							<input id="options" data-bind="value: text" placeholder="Add option" class="form-control unedit add-question-option">
							
							<a class="unedit fa fa-times" href="#" data-bind="click: $parent.removeOption"></a>
						</div>
					</div> 
				</div>
				<div class="panel-footer">
					<button data-bind="click: addOption" class="unedit">Add option</button>
					<button data-bind="click: saveQuestion" class="unedit">Save question</button>
				</div>
			</div>
		</div>
	</form>

<<<<<<< HEAD
<form id="paper-container" class="container">
	<div class="form-group col-xs-6">
		<label>Paper title: </label> 
		<input type="text" id="title" class="form-control" />
	</div>
	<div class="form-group col-xs-2">
		<label>Duration: </label> 
		<div class="controls form-inline">
			<input type="text" id="duration_hr" placeholder="Hours" class="form-control col-xs-6" />
			<input type="text" id="duartion_min" placeholder="Minutes" class="form-control col-xs-6" />
		</div>
	</div>
	<div class="form-group col-xs-6">
		<label>Paper description</label>
		<textarea id="description" class="form-control" ></textarea>
	</div>
</form>
<form id="newQuestion">
	<div data-bind="css : { edit: edit() != false }">
		<input type="text" id="question" data-bind="value: question" placeholder="Add question" class="form-control unedit">
		<div data-bind="foreach: options">
			<input  type="checkbox" data-bind="click: $parent.toggleCheckbox" class="unedit" /><input id="options" data-bind="value: text" placeholder="Add option" class="form-control unedit">
			
			<a class="unedit" href="#" data-bind="click: $parent.removeOption">X</a>
		</div> 

		<button data-bind="click: addOption" class="unedit">Add option</button>
		<button data-bind="click: saveQuestion" class="unedit">Save question</button>
	</div>
</form>
 <h3 id = "jsonResponse"></h3>
<span id="jsonObject" class="unedit" data-bind="text: ko.toJSON(questions)" style = "visibility: hidden"></span>
<div id="questions-container" data-bind="foreach: questions">

	<div data-bind="css : { edit: edit() != false }">
		<h3 data-bind="text: question" class="unedit"></h3>
		<input data-bind='value: question, valueUpdate: "afterkeydown"' class="editable"/>	
		
		<!-- <h4 data-bind='value: question' class="editable"></h4>	 -->

		<div data-bind="foreach: options">

			<h5 data-bind="text: text" class="unedit"></h5>
			<span class="unedit" data-bind="text: setAnswer"></span>
=======
	<div id="questions-container" data-bind="foreach: questions">
		
		<div data-bind="css : { edit: edit() != false }">
			<div class="well unedit">
				<h4 data-bind="text: question" ></h4>
				<div data-bind="foreach: options">
					<div class="add-question-option">
						<span data-bind="text: text" ></span>
						<span  data-bind="text: setAnswer" style="color: red"></span>
					</div>
				</div>
				<a href="#" data-bind="click: $parent.removeSavedQuestion" class="unedit">Remove</a>
				<button data-bind="click: $parent.editSavedQuestion, attr: {'data-target': '#'+savedQuestions.questions.indexOf($data)}" class="btn btn-warning btn-xs  btn-lg unedit" data-toggle="modal" data-backdrop="static"  data-keyboard="false" >Edit</button>
			</div>			
			<div class="modal fade" data-bind="attr: {'id': savedQuestions.questions.indexOf($data)}" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
                    <div class="modal-content">
						<div class="modal-header" >Edit question</div>
						<div class="modal-body">
							<textarea data-bind='value: question, valueUpdate: "afterkeydown"' class="form-control editable"></textarea>	
							<div data-bind="foreach: options">
								<div>
									<input class="editable"  type="checkbox" data-bind="checked: setAnswer, click: $parent.toggleCheckbox" class="unedit" />
									<input data-bind="value: text" class="form-control editable add-question-option" type="text"/>				
									
									<a class="editable fa fa-times" href="#" data-bind="click: $parent.removeOption1"></a>
								</div>
							</div>
						</div>						
						<div class="modal-footer">
							<button class="editable fa fa-plus-circle btn btn-default"  data-bind="click: addOption">Add option</button>		
							<button  data-bind="click: $parent.saveEditedQuestion" class="editable btn btn-primary" id="save">Save changes</button>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	 <button id="submit" class="btn btn-outline btn-default" onclick="sendRequestToServerPost()">Add paper</button>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{url()}}/js/knockout-3.3.0.js"></script>
<script type="text/javascript">
	editable = ko.observable(true);

	var Option = function(){
		var self = this;

		this.text = ko.observable('');
		this.setAnswer = ko.observable(false);

	}

	var Question = function(){
		var self = this;

		this.question = ko.observable();
		this.options = ko.observableArray();

		this.edit = ko.observable(false);

		this.notEdit = ko.computed(function(){
			return !self.edit();
		}, this);

		
		this.removeOption1 = function(option){
			if(self.options().length > 1){
				self.options.remove(option);
			}
		}
		this.addOption = function(){
			self.options.push(new Option());
		}

	}

	var savedQuestionsView = function(){
		var self = this;
		
		this.questions = ko.observableArray();

		this.removeSavedQuestion = function(){
			self.questions.remove(this);
		}

		this.editSavedQuestion = function(k,e){
			
			if(editable()){	
				editable(!(editable()));
				this.edit(!this.edit());
				
				currQuestion.edit(!currQuestion.edit());

			}
		}

		this.saveEditedQuestion = function(data){
			
			if(this.question() !== ""){
				x=0;
				for (var i = this.options().length - 1; i >= 0; i--) {
					
					if(this.options()[i].text() !== ""){
						x=1;
						break;
					}
				}
				
				if(x==1){

					this.edit(!this.edit());
					currQuestion.edit(!currQuestion.edit());
					for (var i = this.options().length - 1; i >= 0; i--) {

						if(this.options()[i].text() == ""){
							this.options.remove(this.options()[i]);							
							

						}
						var modal = '#'+self.questions.indexOf(data);
						$(modal).modal('hide');
						
					}
					editable(!(editable()));
				}else{
					alert('Atleast a single option need to be added');
				}
			
			}else{
				alert('Question field is required');
			}
		}
		
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
			if(self.question() !== ""){
				x=0;
				for (var i = self.options().length - 1; i >= 0; i--) {
					
					if(self.options()[i].text() !== ""){
						x=1;
						break;
					}
				}
				
				if(x==1){
					var question = new Question();
					question.question(self.question());
				
					self.options().forEach(function(e){ 
						if(!(e.text().trim() == '')){

							option = new Option()
							option.text(e.text());
							option.setAnswer(e.setAnswer());
							question.options.push(option);
						}
					});
			
					savedQuestions.questions.push(question);

					self.question('');
					self.options([new Option()]);
				
				}else{
					alert('Atleast a single option need to be added');
			}
				
			}else{
				alert('Question field is required');
			}			
			
		}

		this.removeOption = function(){
			if(self.options().length > 1){
				self.options.remove(this);
			}
				
		}

		this.toggleCheckbox = function(){
			
			this.setAnswer(!(this.setAnswer()));
	        return true;
		}

	}

	
	var currQuestion = new currentQuestionInput();
	var savedQuestions = new savedQuestionsView();
	// var paper = ko.toJSON(savedQuestions);
	
	ko.applyBindings(currQuestion, document.getElementById('newQuestion'));
	ko.applyBindings(savedQuestions, document.getElementById('questions-container'));
	ko.applyBindings(savedQuestions, document.getElementById('jsonObject'));

	function sendRequestToServerPost() {

		// send all the details to the server by an Ajax request

		var title = document.getElementById('title').value;
		var duration_hr = document.getElementById('duration_hr').value;
		var duration_min = document.getElementById('duartion_min').value;
		var description = document.getElementById('description').value;
		var paper = document.getElementById('jsonObject').innerHTML;
		var type = 1;

		// console.log(savedQuestions);
		// console.log(savedQuestions.questions());
		// var paper = JSON.stringify(savedQuestions);

		var headers = 'title=' + title + '&description=' + description + '&hours=' + duration_hr + '&mins=' + duration_min + '&paper=' + paper + '&type=' + type;
		console.log(headers);

		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
	    		document.getElementById('jsonResponse').innerHTML = xmlhttp.responseText;
	    	}
	  	}

		xmlhttp.open("POST","{{url()}}/admin/paper/create",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(headers);
	}

</script>
@stop