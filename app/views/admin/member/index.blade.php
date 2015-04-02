@extends('admin.layouts.main')

@section('content')

@if(Session::has('message'))

	<p>{{ Session::get('message') }}</p>

@endif

<table border = "1">
	<tr>
		<th>User ID</th>
		<th>Name</th>
		<th>User Type</th>
		<th>Sex</th>
		<th>NIC</th>
		<th>Council Registration No.</th>
		<th>District</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

@foreach($members as $member)
	<tr>
		<td>{{ $member->id }}</td>
		<td>{{ $member->name }}</td>
		@if($member->type == '1')
			<td>Super Admin</td>
		@elseif($member->type == '2')
			<td>Admin</td>
		@elseif($member->type == '3')
			<td>Admin</td>
		@endif
		<td>{{ $member->sex }}</td>
		<td>{{ $member->nic }}</td>
		<td>{{ $member->concil_registration_no }}</td>
		<td>{{ $member->district }}</td>
		<td>
			{{ Form::open(array('url'=>'admin/member/edit')) }}

				{{ Form::hidden('id', $member->id) }}
				{{ Form::submit('Edit') }}

			{{ Form::close() }}
		</td>
		<td>
			{{ Form::open(array('url'=>'admin/member/destroy')) }}

				{{ Form::hidden('id', $member->id) }}
				{{ Form::submit('Delete') }}

			{{ Form::close() }}
		</td>
	</tr>
@endforeach
	
</table>

<div>
	{{ $members->links() }}
</div>

@stop