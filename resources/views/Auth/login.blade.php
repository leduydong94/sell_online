@extends('layouts.master')
@section('title')
	<title>Login</title>
@endsection
@section('content')
	<div class="container">
		<div id="content">
			
			<form action="{{ route('login') }}" method="POST" role="form">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4><b>Login</b></h4>
						<div class="space20">&nbsp;</div>

						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif

						@if (session('successSignup'))
							<div class="alert alert-success">{{ session('successSignup') }}</div>
							@php
								Session::forget('successSignup');
							@endphp
						@endif

						@if (session('emailNotCorrect'))
							<div class="alert alert-danger">{{ session('emailNotCorrect') }}</div>
						@endif

						@if (session('passwordNotCorrect'))
							<div class="alert alert-danger">{{ session('passwordNotCorrect') }}</div>
						@endif
						
						@csrf
			
						<div class="form-group">
							<label for="">Email</label>
							<input type="text" class="form-control" id="" placeholder="Input Email" name="email" value="{{ old('email') }}">
						</div>
					
						<div class="form-group">
							<label for="">Password</label>
							<input type="password" class="form-control" id="" placeholder="********" name="password">
						</div>	
					
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@stop