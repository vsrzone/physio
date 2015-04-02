@extends('admin.layouts.main')

@section('content')

@if(Session::has('message'))

	<p>{{ Session::get('message') }}</p>

@endif

<table border = "1">
	<tr>
		<th>User ID</th>
		<th>Username</th>
		<th>User Type</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

@foreach($users as $user)
	<tr>
		<td>{{ $user->id }}</td>
		<td>{{ $user->name }}</td>
		@if($user->type == '1')
			<td>Super Admin</td>
		@elseif($user->type == '2')
			<td>Admin</td>
		@elseif($user->type == '3')
			<td>Admin</td>
		@endif
		<td>
			{{ Form::open(array('url'=>'admin/user/edit')) }}

				{{ Form::hidden('id', $user->id) }}
				{{ Form::submit('Edit') }}

			{{ Form::close() }}
		</td>
		<td>
			{{ Form::open(array('url'=>'admin/user/destroy')) }}

				{{ Form::hidden('id', $user->id) }}
				{{ Form::submit('Delete') }}

			{{ Form::close() }}
		</td>
	</tr>
@endforeach
	
</table>

<div>
	{{ $users->links() }}
</div>

@stop