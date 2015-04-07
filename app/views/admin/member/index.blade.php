@extends('admin.layouts.main')

@section('content')

@if(Session::has('message'))

	<div class="alert alert-danger">{{ Session::get('message') }}</div>

@endif

<table border = "1" class="table table-striped table-bordered table-hover dataTable no-footer">
	<tr>
		<th>User ID</th>
		<th>Name</th>
		<th>User Type</th>
		<th>Gender</th>
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

		@if($member->sex == '0')
			<td>Male</td>
		@elseif($member->sex == '1')
			<td>Female</td>
		@endif
		<td>{{ $member->nic }}</td>
		<td>{{ $member->concil_registration_no }}</td>
		<td>{{ $member->district }}</td>
		<td>
			{{ Form::open(array('url'=>'admin/member/edit')) }}

				{{ Form::hidden('id', $member->id) }}
				{{ Form::submit('Edit', array('class'=>'btn btn-info')) }}

			{{ Form::close() }}
		</td>
		<td>
			{{ Form::open(array('url'=>'admin/member/destroy')) }}

				{{ Form::hidden('id', $member->id) }}
				{{ Form::submit('Delete', array('class'=>'btn btn-danger')) }}

			{{ Form::close() }}
		</td>
	</tr>
@endforeach
	
</table>

<div>
	{{ $members->links() }}
</div>

@stop