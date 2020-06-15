@extends('layouts.dashboard')
@section('title')
	<title>Product Types</title>
@endsection
@section('content')
	<h1>List Product Type</h1>
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
		<div style="float: right; padding-left: 586px"><a href="{{ route('create-type') }}" class="btn btn-primary">Add New Product Type</a></div>
	</form>

	<br>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($productTypes as $productType)
				<tr>
					<td>{{ $productType->id }}</td>
					<td>{{ $productType->name }}</td>
					<td>{{ $productType->description }}</td>
					<td>
						<a href="{{ route('edit-type', ['id' => $productType->id]) }}" class="btn btn-primary">Edit</a>
						<form action="{{ route('delete-type', ['id' => $productType->id]) }}" method="POST" role="form" style="display: inline-block;">
							@csrf
							@method('DELETE')						
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
			
		</tbody>
	</table>
	{{ $productTypes->appends($_GET) }}
@stop