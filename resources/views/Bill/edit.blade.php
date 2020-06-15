@extends('layouts.dashboard')
@section('title')
	<title>Update Status</title>
@endsection
@section('content')
	<form action="{{ route('update-bill', ['id' => $bill->id]) }}" method="POST" role="form">
		<legend>Update Status</legend>
		@csrf
		@method('PUT')
		<div class="form-group">
			<label for="">Status</label>
			<select name="status" id="inputStatus" class="form-control" required="required">
				<option value="0" {{ $bill->status == 0 ? 'selected' : '' }}>Has received</option>
				<option value="1" {{ $bill->status == 1 ? 'selected' : '' }}>Processing</option>
				<option value="2" {{ $bill->status == 2 ? 'selected' : '' }}>Accomplished</option>
			</select>
		</div>
	
		
	
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
@stop