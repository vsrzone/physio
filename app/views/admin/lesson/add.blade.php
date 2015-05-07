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
{{ Form::open(array('url'=>'admin/lesson/create', 'files'=>true)) }}
<div> Lesson topic: {{ Form::text('topic', '', array('class'=>'form-control', 'required', 'id'=>'topic')) }} </div>
<div>Content: {{ Form::textarea('content', '', array('id'=>'content')) }}</div>
<div> {{ Form::file('files[]', array('id'=>'file', 'multiple')) }} </div>
<div id="file_upload"></div>
<div id="uploadForm1"></div>
<div> {{ Form::button('Add Lesson', array('class'=>'btn btn-default', 'id'=>'submit')) }} </div>
{{ Form::close() }}

<script type="text/javascript" src="{{url()}}/js/admin/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">

	tinymce.init({
	    selector: "textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
        	"insertdatetime media table contextmenu paste"
	    ],
	    media_dimensions: false,
    	image_dimensions: false,
	 });

</script>
<script type="text/javascript">

	var fileSelect = document.getElementById( "file" );
	var uploadDiv = document.getElementById( "submit" );

	document.getElementById('file').onchange = function(){
		
		uploadForm1.innerHTML = "";
		for (var i = fileSelect.files.length - 1; i >= 0; i--) {
			uploadForm1.innerHTML += fileSelect.files[i]["name"] +" ["+fileSelect.files[i]["size"]/1000000+ "Mb]" +"<br>";
			if(fileSelect.files[i]["size"] >= 2000000){				
				alert('Selected file is too large to upload');
				document.getElementById('file').value = document.getElementById('file').defaultValue;
				uploadForm1.innerHTML = "";				
				break;
			}
		}		
	}

	document.getElementById('submit').onclick = function( event ) {
	   
	    uploadData();	    
	};

	var uploadData = function(){

		var topic = document.getElementById('topic').value;
		var content = tinyMCE.get('content').getContent();
	
		if(topic != "" && content != ""){
			var formData = new FormData(  );
        	var request = new XMLHttpRequest();

			formData.append('topic', topic);
			formData.append('content',content);
			request.open( 'POST', '{{url()}}/admin/lesson/create', true );
	        request.onload = function(  ) {
	            if ( request.status === 200 ) {	
	                if(request.responseText){
	                	uploadFiles(request.responseText);
	                }
	            } else {
	                console.log( "Error" );
	            }
	        };
			request.send( formData );
		}else{
			alert('Topic and content fields are required.');
			return false;
		}
		
		
	}

	var uploadFiles = function(x) {
	   	var lesson_id = x;
	    var files = fileSelect.files;
	    handleFile( files, 0 , lesson_id, 0);
	};
	function handleFile( files, index, x, y) {
	  if(files.length <= 0){
	  	return false;
	  }
	
	  	var lesson_id = x;
	    if( files.length > index ) {

	        var formData = new FormData(  );
	        var request = new XMLHttpRequest(  );

	        formData.append( 'files', files[ index ] );
	        formData.append( 'lesson_id', lesson_id );
	        formData.append('id', y);
	        formData.append( 'upload_submit', true );
	        request.open( 'POST', '{{url()}}/admin/lesson/fileupload', true );
	        request.onload = function(  ) {
	            if ( request.status === 200 ) {
	                console.log( "Uploaded" );
	                
	                handleFile( files, ++index, lesson_id, request.responseText);
	            } else {
	                console.log( "Error" );
	            }
	        };
	        request.send( formData );
	    }else{
	    	window.location.assign('{{url()}}/admin/lesson/index');
	   }    
	}

</script>
@stop