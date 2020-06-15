@extends('layouts.master')
@section('title')
		<title>Product Types</title>
@endsection
@section('content')
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach ($productTypes as $product_Type)
								<li><a href="{{ route('product-type', ['typeId' => $product_Type->id]).'?keyword='.Request::get('keyword') }}">{{ $product_Type->name }}</a></li>
							@endforeach
							
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4><b>{{ $productType->name }}</b></h4>
							<div class="beta-products-details">												<div class="clearfix"></div>
						</div>
							
							<div class="row">
								@foreach ($product_types as $product_type)
								<div class="col-sm-4">
									<div class="single-item">
										@if ($product_type->sale_price != 0)
											<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="{{ route('product-detail', ['productId' => $product_type->id ]) }}"><img src="{{ $product_type->image }}" alt=""></a>
										</div>

								<div class="single-item-body">
											<p class="single-item-title"><b>{{ $product_type->name }}</b></p>
											<p class="single-item-price">
												@if ($product_type->sale_price == 0)
													<span><b>${{ $product_type->unit_price }}</b></span>
												@else
													<span class="flash-del"><b>${{ $product_type->unit_price }}</b></span>
													<span class="flash-sale"><b>${{ $product_type->sale_price }}</b></span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{ route('add-to-cart', ['productId' => $product_type->id ]) }}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{ route('product-detail', ['productId' => $product_type->id ]) }}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
									<br>
								</div>
							@endforeach	
							</div>

						</div> <!-- .beta-products-list -->
						{{ $product_types->appends($_GET) }}
						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4><b>Others Products</b></h4>
							<div class="beta-products-details">
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach ($others_product as $other_product)
									<div class="col-sm-4">
									<div class="single-item">
										<div class="single-item-header">
											<a href="{{ route('product-detail', ['productId' => $other_product->id ]) }}"><img src="{{ $other_product->image }}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title"><b>{{ $other_product->name }}</b></p>
											<p class="single-item-price">
												@if ($other_product->sale_price != 0 && $other_product->sale_price < $other_product->unit_price)
													<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
													<span class="flash-del" style="font-size: 20px"><b>${{ $other_product->unit_price }}</b></span>
													<span class="flash-sale" style="font-size: 20px"><b>${{ $other_product->sale_price }}</b></span>
													
												@else
													<span><b>${{ $other_product->unit_price }}</b></span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{ route('add-to-cart', ['productId' => $other_product->id ]) }}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{ route('product-detail', ['productId' => $other_product->id ]) }}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
								

							</div>
							<div class="space40">&nbsp;</div>
						</div> <!-- .beta-products-list -->

					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@stop