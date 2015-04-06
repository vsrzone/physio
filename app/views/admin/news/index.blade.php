@extends('admin.layouts.main')

@section('content')
@if(Session::has('message'))
	<div> {{ Session::get('message') }} </div>
@endif

<table border="1">
	<tr>
		<th>News ID</th>
		<th>News title</th>
		<th>Category</th>
		<th>News date</th>
		<th colspan="2">Edit/Delete</th>
	</tr>
	@foreach($allnews as $news)
		<tr>
			<td> {{ $news->id }} </td>
			<td> {{ $news->title }} </td>
			<td> {{ $news->name }} </td>
			<td> {{ $news->news_date }} </td>
			{{Form::open(array('url'=>'admin/news/edit'))  }}
			{{ Form::hidden('id', $news->id) }}
			<td> {{ Form::submit('Edit') }} </td>
			{{ Form::close() }}
			{{Form::open(array('url'=>'admin/news/destroy'))  }}
			{{ Form::hidden('id', $news->id) }}
			<td> {{ Form::submit('Delete') }} </td>
			{{ Form::close() }}
		</tr>
	@endforeach
</table>
<div> {{ $allnews->links() }} </div>
@stop