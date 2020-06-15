@extends('layouts.dashboard')
@section('title')
	<title>Bill Details</title>
@endsection
@section('content')
	<h1>Bill Details</h1>
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
				<th>Bill ID</th>
				<th>Product ID</th>
				<th>Product</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Updated At</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($billDetails as $billDetail)
				<tr>
					<td>{{ $billDetail->id }}</td>
					<td>{{ $billDetail->bill_id }}</td>
					<td>{{ $billDetail->product_id }}</td>
					<td>{{ $billDetail->product->name }}</td>
					<td>{{ $billDetail->quantity }}</td>
					<td>{{ $billDetail->unit_price }}</td>
					<td>{{ $billDetail->updated_at }}</td>
					<td>{{ $billDetail->status }}</td>
					<td>
						<a href="{{ route('edit-detail', ['id' => $billDetail->id]) }}" class="btn btn-primary">Update</a>
						@if (Auth::isAdmin())
						<form action="{{ route('delete-detail', ['id' => $billDetail->bill_id]) }}" method="POST" role="form" style="display: inline-block;">
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
	{{ $billDetails->appends($_GET) }}
@stop