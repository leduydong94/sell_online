@extends('layouts.master')
@section('title')
		<title>Product Detail</title>
@endsection
@section('content')
		<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="{{ $product->image }}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title"><h3>{{ $product->name }}</h3></p>
								<p class="single-item-price">
									@if ($product->sale_price != 0 && $product->sale_price < $product->unit_price)
													<span class="flash-del" style="font-size: 20px"><b>${{ $product->unit_price }}</b></span>
													<span class="flash-sale" style="font-size: 20px"><b>${{ $product->sale_price }}</b></span>
													
												@else
													<span><b>${{ $product->unit_price }}</b></span>
												@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{ $product->infor }}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Quantity:</p>
							<div class="single-item-options">
								{{-- <select class="wc-select" name="color">
									<option>Quantity</option>
									@for ($i = 1; $i <= 10 ; $i++)
										<option value="$i" name='qty'>{{$i}}</option>
									@endfor
								</select>
								<a class="add-to-cart" href="{{ route('add-to-cart', ['productId' => $product->id ]) }}"><i class="fa fa-shopping-cart"></i></a> --}}
								<form action="{{ route('add-to-cart', ['productId' => $product->id ]) }}" method="Get" class="form-inline" role="form">
								
									<div class="form-group">
										<select name="qty" id="input" class="form-control" required="required">
											@for ($i = 1; $i <= 10 ; $i++)
												<option value="{{$i}}">
													{{ $i }}
												</option>
											@endfor
											
										</select>
									</div>
								
									
								
									<button type="submit" class="add-to-cart btn btn-primary" ><i class="fa fa-shopping-cart" style="line-height: 24px !important"></i></button>
									{{-- <a type="submit" class="add-to-cart" href="{{ route('add-to-cart', ['productId' => $product->id ]) }}"><i class="fa fa-shopping-cart"></i></a> --}}
								</form>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Description</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{{ $product->description }}</p>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4><b>Related Products</b></h4>
						<br>
						<div class="row">
							@foreach ($relatedProducts as $related)
								<div class="col-sm-4">
								<div class="single-item">
									@if ($related->sale_price != 0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="{{ route('product-detail', ['productId' => $related->id ]) }}"><img src="{{ $related->image }}" alt="" height="200px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{ $related->name }}</p>
										<p class="single-item-price">
											@if ($related->sale_price == 0)
													<span><b>${{ $related->unit_price }}</b></span>
												@else
													<span class="flash-del"><b>${{ $related->unit_price }}</b></span>
													<span class="flash-sale"><b>${{ $related->sale_price }}</b></span>
												@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{ route('add-to-cart', ['productId' => $related->id ]) }}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{ route('product-detail', ['productId' => $related->id ]) }}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
								<br>
							</div>
							@endforeach
							

						</div>
						
					</div> <!-- .beta-products-list -->
					{{ $relatedProducts->appends($_GET) }}
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">New Products</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach ($newProducts as $newProduct)
								<div class="media beta-sales-item">
									<a class="pull-left" href="{{ route('product-detail', ['productId' => $newProduct->id ]) }}"><img src="{{ $newProduct->image }}" alt="" height="100px"></a>
									<div class="media-body">
										{{ $newProduct->name }}
										<br>
										@if ($newProduct->sale_price == 0)
													<span class="beta-sales-price"><b>${{ $newProduct->unit_price }}</b></span>
												@else
													<span class="flash-del beta-sales-price">${{ $newProduct->unit_price }}</span>
													<span class="flash-sale beta-sales-price"><b>${{ $newProduct->sale_price }}</b></span>
												@endif
									</div>
								</div>
								@endforeach
								

							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">Sale Products</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach ($saleProducts as $saleProduct)
								<div class="media beta-sales-item">
									<a class="pull-left" href="{{ route('product-detail', ['productId' => $saleProduct->id ]) }}"><img src="{{ $saleProduct->image }}" alt="" height="100px"></a>
									<div class="media-body">
										{{ $saleProduct->name }}
										<br>
											<span class="flash-del beta-sales-price">${{ $saleProduct->unit_price }}</span>
											<span class="flash-sale beta-sales-price"><b>${{ $saleProduct->sale_price }}</b></span>
									</div>
								</div>
								@endforeach
								

							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@stop
