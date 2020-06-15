@extends('layouts.dashboard')
@section('title')
	<title>Bill</title>
@endsection
@section('content')
	<h1>List Bill</h1>
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
				<th>Customer ID</th>
				<th>Order Date</th>
				<th>Total Price</th>
				<th>Payment</th>
				<th>Note</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($bills as $bill)
				<tr>
					<td>{{ $bill->id }}</td>
					<td>{{ $bill->customer_id }}</td>
					<td>{{ $bill->order_date }}</td>
					<td>{{ $bill->total }}</td>
					<td>{{ $bill->payment }}</td>
					<td>{{ $bill->note }}</td>
					<td>{{ $bill->status }}</td>
					<td>
						@if (!Auth::isShipper())
							<a href="{{ route('edit-bill', ['id' => $bill->id]) }}" class="btn btn-primary">Update</a>
						@endif
						
						@if (Auth::isAdmin())
						<form action="{{ route('delete-bill', ['id' => $bill->id]) }}" method="POST" role="form" style="display: inline-block;">
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
	{{ $bills->appends($_GET) }}
@stop