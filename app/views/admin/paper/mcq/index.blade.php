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

<table border = "1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>Paper ID</th>
		<th>Title</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

@foreach($questions as $question)
	<tr>
		<td>{{ $question->id }}</td>
		<td>{{ $question->title }}</td>
		<td>
			{{ Form::open(array('url'=>'admin/paper/mcq/edit')) }}

				{{ Form::hidden('id', $question->id) }}
				{{ Form::submit('Edit', array('class'=>'btn btn-info')) }}

			{{ Form::close() }}
		</td>
		<td>
			{{ Form::open(array('url'=>'admin/paper/mcq/destroy')) }}

				{{ Form::hidden('id', $question->id) }}
				{{ Form::submit('Delete', array('class'=>'btn btn-danger')) }}

			{{ Form::close() }}
		</td>
	</tr>
@endforeach
	
</table>

<div>
	{{ $questions->links() }}
</div>
@stop