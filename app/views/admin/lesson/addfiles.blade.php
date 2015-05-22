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
{{ Form::open(array('url'=>'admin/lesson/updatefiles', 'files'=>true)) }}
{{ Form::hidden('lesson_id', $lesson_id, array('id'=> 'lesson_id')) }}

@foreach($attaches as $attach)
	<div> {{ $attach->title }} </div>
@endforeach
<div> {{ Form::file('files[]', array('id'=>'file', 'multiple')) }} </div>
<div id="file_upload"></div>
<div id="uploadForm1"></div>
<div> {{ Form::button('Add Files', array('class'=>'btn btn-default', 'id'=>'submit')) }} </div>

{{ Form::close() }}

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">

	tinymce.init({
	    selector: "textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
        	"insertdatetime media table contextmenu paste"
	    ],
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
	   	
	    uploadFiles(document.getElementById('lesson_id').value);	    
	};

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