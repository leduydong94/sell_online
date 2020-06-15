@extends('layouts.dashboard')
@section('title')
	<title>Users</title>
@endsection
@section('content')
	<h1>List User</h1>
	@if (session('success'))
	        <div class="alert alert-success">{{session('success')}}</div>
    @endif
	<form action="" method="get" class="form-inline" role="form">
		
		<div class="form-group">
			<label class="sr-only" for="">label</label>
			<input type="text" class="form-control" id="" placeholder="Input Name" name="keyword" value="{{ Request::get('keyword') }}">
		</div>
		&nbsp;&nbsp;
		<button type="submit" class="btn btn-primary">Search</button>
		@if (Auth::isAdmin())
			<div style="float: right; padding-left: 586px"><a href="{{ route('create-user') }}" class="btn btn-primary">Add New User</a></div>
		@endif	
	</form>

	<br>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Role</th>
				<th>Updated At</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->full_name }}</td>
					<td>{{ $user->email }}</td>
					<td>
						@foreach ($user->roles as $role)
							<span class="label label-success">
								{{ $role->name }} &nbsp;
							</span>
						@endforeach
					</td>
					<td>{{ $user->updated_at }}</td>
					<td>
						@if (Auth::isAdmin())
						<a href="{{ route('edit-user', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
						<form action="{{ route('delete-user', ['id' => $user->id]) }}" method="POST" role="form" style="display: inline-block;">
							@csrf
							@method('DELETE')						
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
						@endif
						
					</td>
				</tr>
			@endforeach
			
		</tbody>
	</table>
	{{ $users->appends($_GET) }}
@stop