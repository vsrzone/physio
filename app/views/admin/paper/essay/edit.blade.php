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
			<input type="hidden" value="{{$essay->id}}" id="paper_id" />
			<div class="form-group col-xs-6">
				<label>Paper title: </label> 
				<input type="text" id="title" class="form-control" value="{{$essay->title}}" />
			</div>
			<div class="form-group col-xs-6">
				<label class="col-xs-12">Duration: </label> 
				<div class="controls form-inline">
					<input type="text" id="duration_hr" placeholder="Hours" class="form-control col-xs-6" value="{{(int)($essay->duration/60)}}" />
					<input type="text" id="duartion_min" placeholder="Minutes" class="form-control col-xs-6" value="{{$essay->duration%60}}" />
				</div>
			</div>
			<div class="col-xs-12 alert alert-success alert-dismissable">
				<label>Examiners</label>
				@foreach($examiners as $examiner)
				<div>				
					<input type="checkbox" name="examiners[]" value="{{$examiner->user_id}}" id="examiners"<?php
							if(in_array($examiner->user_id, explode(',', $essay->examiners))) {echo "checked";}
							?> />					
					<label>{{$examiner->name.'('.$examiner->email.')'}}</label>
				</div>
				@endforeach
			</div>
			<div class="form-group col-xs-6">
				<label>Paper description</label>
				<textarea id="description" class="form-control" >{{$essay->description}}</textarea>
			</div>
		</div>
	</form>
	<form id="newQuestion">
		<div data-bind="css : { edit: edit() != false }">
			<div class="panel panel-default unedit">
				<div class="panel-heading">Add new Question...</div>
				<div class="panel-body">
					<textarea id="question" data-bind="value: question" placeholder="Add question" class="form-control unedit"></textarea>
					<div>							
						<input id="marks" data-bind="value: marks" placeholder="Marks for question" class="form-control unedit add-question-option">					
					</div>					
				</div>
				<div class="panel-footer">					
					<button data-bind="click: saveQuestion" class="unedit">Save question</button>
				</div>
			</div>
		</div>
	</form>
	 <h3 id = "jsonResponse"></h3>
	<div id="questions-container" data-bind="foreach: questions">
		
		<div data-bind="css : { edit: edit() != false }">
			<div class="well unedit">
				<h4 data-bind="text: 'Question '+(savedQuestions.questions.indexOf($data)+1)"></h4>
				<h4 data-bind="text: question" ></h4>			
				<span  data-bind="text: '[Marks '+ marks() +']'" style="color: red"></span>	
				
				<a href="#" data-bind="click: $parent.removeSavedQuestion" class="unedit">Remove</a>
				<button data-bind="click: $parent.editSavedQuestion, attr: {'data-target': '#'+savedQuestions.questions.indexOf($data)}" class="btn btn-warning btn-xs  btn-lg unedit" data-toggle="modal" data-backdrop="static"  data-keyboard="false" >Edit</button>
			</div>			
			<div class="modal fade" data-bind="attr: {'id': savedQuestions.questions.indexOf($data)}" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
                    <div class="modal-content">
						<div class="modal-header" >Edit question</div>
						<div class="modal-body">
							<textarea data-bind='value: question, valueUpdate: "afterkeydown"' class="form-control editable"></textarea>	
							<div>								
								<input data-bind="value: marks" class="form-control editable add-question-option" type="text"/>								
							</div>							
						</div>						
						<div class="modal-footer">									
							<button  data-bind="click: $parent.saveEditedQuestion" class="editable btn btn-primary" id="save">Save changes</button>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	 <button id="submit" class="btn btn-outline btn-default" onclick="sendRequestToServerPost()">Add essay paper</button>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{url()}}/js/knockout-3.3.0.js"></script>
<script type="text/javascript">
editable = ko.observable(true);


window.onload = function(){
	paper = {{$essay->paper}};
	paper = paper.questions;
	for (var j = paper.length - 1; j >= 0; j--) {
		
		var question = new Question();
		question.question(paper[j].question);
		question.marks(paper[j].marks);		

		savedQuestions.questions.push(question);
	}
	
}

	var Question = function(){
		var self = this;

		this.question = ko.observable();
		this.marks = ko.observable();

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
			
			if(editable()){	
				editable(!(editable()));
				this.edit(!this.edit());
				
				currQuestion.edit(!currQuestion.edit());

					
			}
				
					
		}

		this.saveEditedQuestion = function(data){
			
			if(this.question() !== "" && this.marks() !== ""){
				this.edit(!this.edit());
				currQuestion.edit(!currQuestion.edit());	
				
				var modal = '#'+self.questions.indexOf(data);
				$(modal).modal('hide');					
				
				editable(!(editable()));
			}else{
				alert('Question field and marks fields are required for a question');
			}
		}
		
	};

	var currentQuestionInput = function(){
		var self = this;

		this.question = ko.observable('');
		this.marks = ko.observable('');
		
		this.edit = ko.observable(false);

		this.notEdit = ko.computed(function(){
			return !self.edit();
		}, this);

		
		this.saveQuestion = function(){
			if(self.question() !== "" && self.marks() !==""){
				var question = new Question();
				question.question(self.question());			
				question.marks(self.marks());
		
				savedQuestions.questions.push(question);

				self.question('');
				self.marks('');
			}else{
					alert('Question field and marks fields are required to add a question');
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
	
	ko.applyBindings(currQuestion, document.getElementById('newQuestion'));
	ko.applyBindings(savedQuestions, document.getElementById('questions-container'));

	var cleanJson = function(que) {
		//this function remove unwanted properties from the savedQuestions object
		
		var copy = ko.toJS(que);
		for (var i = copy.questions.length - 1; i >= 0; i--) {

			delete copy.questions[i].edit;
			delete copy.questions[i].notEdit;
		};
		return copy;
	}

	function sendRequestToServerPost() {

		// send all the details to the server by an Ajax request

		var id = document.getElementById('paper_id').value;
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

					var headers = 'id=' + id + '&title=' + title + '&examiners=' + selectedRows + '&description=' + description + '&hours=' + duration_hr + '&mins=' + duration_min + '&paper=' + paper + '&type=' + type;

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

					xmlhttp.open("POST","{{url()}}/admin/paper/essay/update",true);
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
@stop