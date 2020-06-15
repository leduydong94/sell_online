@extends('layouts.dashboard')
@section('title')
	<title>Customers</title>
@endsection
@section('content')
	<h1>List Customer</h1>
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
	</form>

	<br>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Full Name</th>
				<th>Gender</th>
				<th>Email</th>
				<th>Address</th>
				<th>Phone</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($customers as $customer)
				<tr>
					<td>{{ $customer->id }}</td>
					<td>{{ $customer->name }}</td>
					<td>{{ $customer->gender == 1 ? "Male" : "Female" }}</td>
					<td>{{ $customer->email }}</td>
					<td>{{ $customer->address }}</td>
					<td>{{ $customer->phone }}</td>
					<td>
						@if (Auth::isAdmin())
						<form action="{{ route('delete-customer', ['id' => $customer->id]) }}" method="POST" role="form" style="display: inline-block;">
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
	{{ $customers->appends($_GET) }}
@stop