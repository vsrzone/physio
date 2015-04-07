@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-danger"> {{ Session::get('message') }} </div>
@endif

<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>Category ID</th>
		<th>Category name</th>
		<th colspan="2">Edit/Delete</th>
	</tr>
	@foreach($categories as $category)
		<tr>
			<td> {{ $category->id }} </td>
			<td> {{ $category->name }} </td>
			{{Form::open(array('url'=>'admin/category/edit'))  }}
			{{ Form::hidden('id', $category->id) }}
			<td> {{ Form::submit('Edit', array('class'=>'btn btn-info')) }} </td>
			{{ Form::close() }}
			{{Form::open(array('url'=>'admin/category/destroy'))  }}
			{{ Form::hidden('id', $category->id) }}
			<td> {{ Form::submit('Delete', array('class'=>'btn btn-danger')) }} </td>
			{{ Form::close() }}
		</tr>
	@endforeach
</table>
<div> {{$categories->links()}} </div>
@stop