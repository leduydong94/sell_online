	@extends('layouts.master')
	@section('title')
		<title>Home</title>
	@endsection
	@section('content')
	<div class="container">
		<div class="rev-slider">
			<div class="fullwidthbanner-container">
				<div class="fullwidthbanner">
					<div class="bannercontainer" >
				    <div class="banner" >
						<ul>
							@foreach ($slides as $slide)
							<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
					            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
									<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="{{ $slide->slide }}" data-src="{{ $slide->slide }}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('{{ $slide->slide }}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
									</div>
								</div>

					        </li>
								@endforeach
								
						</ul>
						</div>
					</div>

					<div class="tp-bannertimer"></div>
				</div>
			</div>
					<!--slider-->
		</div>
	</div>
	
	<div class="container">
		<br>
		@if (session('success'))
		<div class="alert alert-success"><b>{{session('success')}}</b></div>
		@endif
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4><b>New Products</b></h4>
							<br>
							<div class="beta-products-details">
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach ($new_products as $new_product)
									<div class="col-sm-3">
									<div class="single-item">
										@if ($new_product->sale_price != 0)
											<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="{{ route('product-detail', ['productId' => $new_product->id ]) }}"><img src="{{ $new_product->image }}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title"><b>{{ $new_product->name }}</b></p>
											<p class="single-item-price">
												
												@if ($new_product->sale_price == 0)
													<span><b>${{ $new_product->unit_price }}</b></span>
												@else
													<span class="flash-del"><b>${{ $new_product->unit_price }}</b></span>
													<span class="flash-sale"><b>${{ $new_product->sale_price }}</b></span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{ route('add-to-cart', ['productId' => $new_product->id]) }}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{ route('product-detail', ['productId' => $new_product->id ]) }}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
										<br>
									</div>
								</div>
								@endforeach
								
							
						</div> <!-- .beta-products-list -->
							{{ $new_products->appends($_GET) }}	
						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4><b>Sale Products</b></h4>
							<div class="beta-products-details">
								{{-- <p class="pull-left">438 styles found</p> --}}
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach ($sale_products as $sale_product)
								<div class="col-sm-3">
									<div class="single-item">
										<div class="single-item-header">
											<a href="{{ route('product-detail', ['productId' => $sale_product->id ]) }}"><img src="{{ $sale_product->image }}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title"><b>{{ $sale_product->name }}</b></p>
											<p class="single-item-price">
												<span class="flash-del"><b>${{ $sale_product->unit_price }}</b></span>
												<span class="flash-sale"><b>${{ $sale_product->sale_price }}</b></span>
												<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{ route('add-to-cart', ['productId' => $sale_product->id ]) }}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{ route('product-detail', ['productId' => $sale_product->id ]) }}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
									<br>
								</div>
			
								@endforeach
								
							</div>

							{{ $sale_products->appends($_GET) }}
							</div>
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->

			
			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->

@stop