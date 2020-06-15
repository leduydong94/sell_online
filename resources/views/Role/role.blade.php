@extends('layouts.dashboard')
@section('title')
	<title>Roles</title>
@endsection
@section('content')
	<h1>List Role</h1>
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
		<div style="float: right; padding-left: 586px"><a href="{{ route('create-role') }}" class="btn btn-primary">Add New Role</a></div>
	</form>

	<br>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Role Name</th>
				<th>Updated At</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($roles as $role)
				<tr>
					<td>{{ $role->id }}</td>
					<td>{{ $role->name }}</td>
					<td>{{ $role->updated_at }}</td>
					<td>
						@if ($role->id != 2 && $role->id != 1)
							<a href="{{ route('edit-role', ['id' => $role->id]) }}" class="btn btn-primary">Edit</a>
							<form action="{{ route('delete-role', ['id' => $role->id]) }}" method="POST" role="form" style="display: inline-block;">
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
	{{ $roles->appends($_GET) }}
@stop