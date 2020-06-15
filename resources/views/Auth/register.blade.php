@extends('layouts.master')
@section('title')
	<title>Register</title>
@endsection
@section('content')
	<div class="container">
		<div id="content">
			
			<form action="{{ route('register') }}" method="POST" role="form">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4><b>Register</b></h4>
						<div class="space20">&nbsp;</div>
						<br>
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif
						
						@if (session('danger'))
							<div class="alert alert-danger">
								{{ session('danger') }}
							</div>
						@endif

						@if (session('duplicate'))
							<div class="alert alert-danger">
								{{ session('duplicate') }}
							</div>
						@endif

						@csrf

			
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" class="form-control" id="" placeholder="example@gmail.com" name="email" value="{{ old('email') }}">
				</div>

				<div class="form-group">
					<input type="hidden" name="role" id="inputRole" class="form-control" value="2" >
				</div>
			
				<div class="form-group">
					<label for="">Full Name</label>
					<input type="text" class="form-control" id="" placeholder="Input Your Fullname" name="fullname" value="{{ old('fullname') }}">
				</div>
			
				<div class="form-group">
					<label for="">Password</label>
					<input type="text" class="form-control" id="" placeholder="******" name="password" value="{{ old('password') }}">
				</div>
			
				<div class="form-group">
					<label for="">Retype Password</label>
					<input type="text" class="form-control" id="" placeholder="******" name="rePassword" value="{{ old('rePassword') }}">
				</div>
			
				
			
				<button type="submit" class="btn btn-primary">Register</button>
				</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->

@stop