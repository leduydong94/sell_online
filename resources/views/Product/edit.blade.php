@extends('layouts.dashboard')
@section('title')
	<title>Update Product</title>
@endsection
@section('content')
	<form action="{{ route('update-product', ['id' => $product->id]) }}" method="POST" role="form" enctype="multipart/form-data">
		<legend>Update Product {{ $product->name }}</legend>

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@csrf
		@method('PUT')
	
		<div class="form-group">
			<label for="">Name</label>
			<input type="text" class="form-control" id="" placeholder="Input Product Name" name="name" value="{{ $product->name }}">
		</div>	
	
		<div class="form-group">
			<label for="">Type</label>
			<select name="type" id="input" class="form-control" required="required">
				@foreach ($types as $type)
					<option value="{{ $type->id }}" {{ $product->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
				@endforeach
				
			</select>
		</div>	
	
		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="inputDescription" class="form-control" rows="3" required="required">{{ $product->description }}</textarea>
		</div>	
	
		<div class="form-group">
			<label for="">Unit Price</label>
			<input type="number" name="unit_price" id="input" placeholder="Input Unit Price" class="form-control" value="{{ $product->unit_price }}">
		</div>
	
		<div class="form-group">
			<label for="">Sale Price</label>
			<input type="number" name="sale_price" id="input" placeholder="Input Sale Price" class="form-control" value="{{ $product->sale_price }}">
		</div>

		<div class="form-group">
			<label for="">Infor</label>
			<input type="text" name="infor" id="input" class="form-control" placeholder="Input Infor" value="{{ $product->infor }}">
		</div>

		<div class="form-group">
			<label for="">New</label>
			<select name="new" id="inputNew" class="form-control" required="required">
				<option value="0" {{ $product->new == 0 ? 'selected' : '' }}>Old</option>
				<option value="1" {{ $product->new == 1 ? 'selected' : '' }}>New</option>
			</select>
		</div>

		<div class="form-group">
			<label for="">Image</label>
			<input type="file" name="image" id="input" class="form-control">
		</div>

		<div class="form-group">
			<label for="">Packing</label>
			<input type="text" name="packing" id="input" class="form-control" value="{{ $product->packing }}">
		</div>
	
		
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
@stop