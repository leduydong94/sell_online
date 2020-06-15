	<div id="header">
		<div class="header-top">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container">			
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<ul class="top-menu menu-beta l-inline">
						<li><a href="https://goo.gl/maps/mygZGAsKA4thn8347" target="_blank"><i class="fa fa-home"></i>121 Kim Nguu, Hai Ba Trung, Hanoi</a></li>
						<li><a href="tel:0987654321"><i class="fa fa-phone"></i> 0987 654 321</a></li>
					</ul>
						</ul>
						
						<ul class="nav navbar-nav navbar-right">
							@if (Auth::check())
								@if (!Auth::isCustomer())
									<li><a href="{{ route('users') }}">Dashboard</a></li>
								@endif
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>{{ $username }} &nbsp;<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li style="font: 13px/20px Open Sans,sans-serif;"><a href="{{ route('get-change-password', ['id' => $user_id]) }}">Change Password</a></li>
										<li style="font: 13px/20px Open Sans,sans-serif;"><a href="{{ route('logout') }}">Log Out</a></li>
									</ul>
								</li>
							@else
								<li><a href="{{ route('get-register') }}">Register</a></li>
								<li><a href="{{ route('get-login') }}">Login</a></li>
							@endif
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="{{ route('index') }}" id="logo"><img src="logo/logo-abc.png" width="250px" height="80px"  alt=""></a>
				</div>
				<div class="pull-right beta-components space-left ov" style="padding-top: 10px">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="">
					        <input type="text" value="{{ Request::get('keyword') }}" name="keyword" id="s" placeholder="Input Keyword" />
					        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>

					<div class="beta-comp">
						<div class="cart">
							<div class="beta-select"><i class="fa fa-shopping-cart"></i> Your Cart (@if (Session::has('cart')){{ session('cart')->totalQuantity }}
								@else Empty
							@endif) <i class="fa fa-chevron-down"></i></div>
							@if (Session::has('cart'))
							<div class="beta-dropdown cart-body">
								
									@foreach ($product_cart as $productCart)
										<div class="cart-item">
											<a href="{{ route('delete-cart', ['productId' => $productCart['item']['id']]) }}" class="cart-item-delete"><i class="fa fa-times"></i></a>
									<div class="media">
										<a class="pull-left" href="{{ route('product-detail', ['productId' => $productCart['item']['id']]) }}"><img src="{{ $productCart['item']['image'] }}" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">{{ $productCart['item']['name'] }}</span>
											<span class="cart-item-amount">{{ $productCart['quantity'] }}*
												@if ($productCart['item']['sale_price'] == 0)
													<span>${{ $productCart['item']['unit_price'] }}</span>
												@else
													{{-- <span class="flash-del">${{ $productCart['item']['unit_price'] }}</span> --}}
													<span class="flash-sale">${{ $productCart['item']['sale_price'] }}</span>
												@endif
											</span>
								
										</div>
									</div>
								</div>
									@endforeach

								<div class="cart-caption">
									<div class="cart-total text-right">Total Price: <span class="cart-total-value"><b>@if (Session::has('cart'))${{ session('cart')->totalPrice }}
									@else 0
									@endif</b>
									</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="{{ route('check-out') }}" class="beta-btn primary text-center">Order <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
							@endif
						</div> <!-- .cart -->
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #0B610B;">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="{{ route('index') }}"><b>Home</b></a></li>
						<li><a href="{{ route('product-type', 1) }}"><b>Product Types</b></a>
							<ul class="sub-menu">
								@foreach ($productTypes as $productType)
									<li><a href="{{ route('product-type', ['typeId' => $productType->id]) }}">{{ $productType->name }}</a></li>
								@endforeach
							</ul>
						</li>
						<li><a href="{{ route('about') }}"><b>About Us</b></a></li>
						<li><a href="{{ route('contact') }}"><b>Contact</b></a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->

		</div> <!-- .header-bottom -->
	</div> <!-- #header -->
	