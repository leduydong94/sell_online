@extends('layouts.master')
@section('title')
	<title>Check Out</title>
@endsection
@section('content')
	<div class="container">
		<div id="content">
			
			<form action="{{ route('post-check-out') }}" method="post" class="beta-form-checkout">
				<div class="row">
					<div class="col-sm-6">
						<h4><b>Order</b></h4>
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

						@csrf	

						<div class="form-block">
							<label for="name"><b>Fullname</b></label>
							<input type="text" id="name" placeholder="Input Your Fullname" name="name" value="{{ isset ($data->name) ? $data->name : old('name') }}">		    
						</div>
						<div class="form-block">
							<label><b>Gender</b></label>
							@if (isset ($user->gender))
								<input id="gender" type="radio" class="input-radio" name="gender" value="1" 
								{{ $data->gender = 1 ? 'checked' : ''}} style="width: 10%"><span style="margin-right: 10%">Male</span>
								<input id="gender" type="radio" class="input-radio" name="gender" value="0" {{ $data->gender = 0 ? 'checked' : ''}}  style="width: 10%"><span>Female</span>
							@else
								<input id="gender" type="radio" class="input-radio" name="gender" value="1" 
								checked="checked" style="width: 10%"><span style="margin-right: 10%">Male</span>
								<input id="gender" type="radio" class="input-radio" name="gender" value="0" style="width: 10%"><span>Female</span>
							@endif		
						</div>

						<div class="form-block">
							<label for="email"><b>Email</b></label>
							<input type="email" id="email"  placeholder="expample@gmail.com" name="email" value="{{ isset ($data->email) ? $data->email : old('email') }}">
						</div>

						<div class="form-block">
							<label for="adress"><b>Address</b></label>
							<input type="text" id="adress" placeholder="Input Your Address"  name="address" value="{{ isset ($data->address) ? $data->address : old('address') }}">
						</div>
						

						<div class="form-block">
							<label for="phone"><b>Phone</b></label>
							<input type="text" id="phone"  name="phone" placeholder="Input Your Phone Number" value="{{ isset ($data->phone) ? $data->phone : old('phone') }}">
						</div>
						
						<div class="form-block">
							<label for="notes"><b>Notes</b></label>
							<textarea id="notes" name="notes">Your note for us</textarea>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="your-order">
							<div class="your-order-head"><h5>Your Cart</h5></div>
							<div class="your-order-body" style="padding: 0px 10px">
								<div class="your-order-item">
									<div>
									<!--  one item	 -->
									@foreach ($product_cart as $productCart)
										<div class="media">
											<img width="25%" src="{{ $productCart['item']['image'] }}" alt="" class="pull-left">
											<div class="media-body">
												<p class="font-large">{{ $productCart['item']['name'] }}</p>
												<span class="color-gray your-order-info">
													{{ $productCart['quantity'] }}*
												@if ($productCart['item']['sale_price'] == 0)
													<span>${{ $productCart['item']['unit_price'] }}</span>
												@else
													<span class="flash-del">${{ $productCart['item']['unit_price'] }}</span>
													<span class="flash-sale">${{ $productCart['item']['sale_price'] }}</span>
												@endif
			
												</span>
											</div>
										</div>
									@endforeach
									<!-- end one item -->
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18">Total Price:</p></div>
									<div class="pull-right"><h5 class="color-black">${{ session('cart')->totalPrice }}</h5></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="your-order-head"><h5>Payments</h5></div>
							
							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs"> Payment on delivery </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											The store will send the goods to your address, you see the products and then pay the delivery staff ! Thank you !
										</div>						
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
										<label for="payment_method_cheque"> Transfer </label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											Transfer money to account number:
											<br>- Account Number: 123 456 789
											<br>- Account holder: Nguyen Van A
											<br>- ABC bank, The Hanoi branch
											<br>-Thank You !
										</div>						
									</li>
									
								</ul>
							</div>

							{{-- <div class="text-center"><a type="submit" class="beta-btn primary">Order <i class="fa fa-chevron-right"></i></a></div> --}}
							<div class="text-center"><button type="submit" class="btn btn-primary">Order <i class="fa fa-chevron-right"></i></button></div>
						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
	</form>
@stop