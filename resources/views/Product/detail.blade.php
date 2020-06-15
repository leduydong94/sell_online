@extends('layouts.dashboard')
@section('title')
	<title>Product Details</title>
	<style>
		th{
			width: 30%;
		}
	</style>
@endsection
@section('content')
	<h1>Product Detail</h1>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<td>{{ $product->id }}</td>
			</tr>
			<tr>
				<th>Name</th>
				<td>{{ $product->name }}</td>
			</tr>
			<tr>
				<th>Type</th>
				<td>{{ $product->type->name }}</td>
			</tr>
			<tr>
				<th>Description</th>
				<td>{{ $product->description }}</td>
			</tr>
			<tr>
				<th>Unit Price</th>
				<td>{{ $product->unit_price }}</td>
			</tr>
			<tr>
				<th>Sale Price</th>
				<td>{{ $product->sale_price }}</td>
			</tr>
			<tr>
				<th>Infor</th>
				<td>{{ $product->infor }}</td>
			</tr>
			<tr>
				<th>New</th>
				<td>{{ $product->new == 1 ? 'New' : 'Old' }}</td>
			</tr>
			<tr>
				<th>Image</th>
				<td><a href="{{ $product->image }}" target="_blank">{{ $product->image }}</a></td>
			</tr>
			<tr>
				<th>Packing</th>
				<td>{{ $product->packing }}</td>
			</tr>
			<tr>
				<th>Updated At</th>
				<td>{{ $product->updated_at }}</td>
			</tr>
			
		</thead>
	</table>
@stop