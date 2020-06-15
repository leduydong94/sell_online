@extends('layouts.dashboard')
@section('title')
	<title>Create Product</title>
@endsection
@section('content')
	<form action="{{ route('store-product') }}" method="POST" role="form" enctype="multipart/form-data">
		<legend>Add New Product</legend>

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
	
		<div class="form-group">
			<label for="">Name</label>
			<input type="text" class="form-control" id="" placeholder="Input Product Name" name="name" value="{{ old('name') }}">
		</div>	
	
		<div class="form-group">
			<label for="">Type</label>
			<select name="type" id="input" class="form-control" required="required">
				@foreach ($types as $type)
					<option value="{{ $type->id }}">{{ $type->name }}</option>
				@endforeach
				
			</select>
		</div>	
	
		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="inputDescription" class="form-control" rows="3" required="required">{{ old('description') }}</textarea>
		</div>	
	
		<div class="form-group">
			<label for="">Unit Price</label>
			<input type="number" name="unit_price" id="input" placeholder="Input Unit Price" class="form-control" value="{{ old('unit_price') }}">
		</div>
	
		<div class="form-group">
			<label for="">Sale Price</label>
			<input type="number" name="sale_price" id="input" placeholder="Input Sale Price" class="form-control" value="{{ old('sale_price') }}">
		</div>

		<div class="form-group">
			<label for="">Infor</label>
			<input type="text" name="infor" id="input" class="form-control" placeholder="Input Infor" value="{{ old('infor') }}">
		</div>

		<div class="form-group">
			<label for="">New</label>
			<select name="new" id="inputNew" class="form-control" required="required">
				<option value="0">Old</option>
				<option value="1">New</option>
			</select>
		</div>

		<div class="form-group">
			<label for="">Image</label>
			<input type="file" name="image" id="input" class="form-control">
		</div>

		<div class="form-group">
			<label for="">Packing</label>
			<input type="text" name="packing" id="input" class="form-control" placeholder="Input Packing" value="{{ old('packing') }}">
		</div>
	
		
		<button type="submit" class="btn btn-primary">Create</button>
	</form>
@stop