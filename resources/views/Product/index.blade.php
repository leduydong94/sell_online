@extends('layouts.dashboard')
@section('title')
	<title>Products</title>
@endsection
@section('content')
	<h1>List Product</h1>
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
		<div style="float: right; padding-left: 586px"><a href="{{ route('create-product') }}" class="btn btn-primary">Add New Product</a></div>
	</form>

	<br>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Type</th>
				<th>New</th>
				<th>Image</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->name }}</td>
					<td>
						{{ $product->type->name }}
					</td>
					<td>{{ $product->new }}</td>
					<td><a href="{{ $product->image }}" target="blank">{{ $product->image }}</a></td>
					<td>
						<a href="{{ route('edit-product', ['id' => $product->id]) }}" class="btn btn-primary">Edit</a>
						<form action="{{ route('delete-product', ['id' => $product->id]) }}" method="POST" role="form" style="display: inline-block;">
							@csrf
							@method('DELETE')						
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
						<a href="{{ route('detail-product', ['id' => $product->id]) }}" class="btn btn-info">Details</a>
					</td>
				</tr>
			@endforeach
			
		</tbody>
	</table>
	{{ $products->appends($_GET) }}
@stop