@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
@if(!empty(\Illuminate\Support\Facades\Session::get('message')))
	@include('sweet::alert')
@endif
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm: {{$products['link']}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach($catalogs as $catalog)
								<li><a href="{{route('sanphamtheoloai',['cata_id'=>$catalog->id,'cate_id'=>null])}}">{{$catalog->name}}</a>
									<ul>
										@foreach($catalog->categories as $category)
											<li><a href="{{route('sanphamtheoloai',['cata_id'=>$catalog->id,'cate_id'=>$category->id])}}">{{$category->name}} </a></li>
										@endforeach
									</ul>

								</li>

							@endforeach


						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Sản phẩm mới</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{$products['products']->total()}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($products['products'] as $product)
									<div class="col-sm-4">
										<div class="single-item">
											@if($product->discount != 0)
												<div class="ribbon-wrapper">
													<div class="ribbon sale">Sale</div>
												</div>
											@endif
											<div class="single-item-header">
												<a href="{{route('productDetail',$product->id)}}"><img
															src="storage/products/{{$product->image_link}}" alt=""
															height="250"></a>
											</div>
											<div class="single-item-body">
												<p class="single-item-title">{{$product->name}}</p>
												<p class="single-item-price">
													@if($product->discount != 0)
														<span class="flash-del">{{number_format($product->price)}}
															VNĐ</span><br>
														<span class="flash-sale">{{number_format($product->price - (($product->price * $product->discount) / 100))}}
															VNĐ</span>
													@else
														<span class="flash-sale">{{number_format($product->price)}}
															VNĐ</span><br><br>
													@endif
												</p>
											</div>
											<div class="single-item-caption">
												<form method="POST" id="addToCart{{$product->id}}" action="{{route('themgiohang')}}" >
													{{ csrf_field() }}
													<input type="hidden" value="{{$product->id}}" name="id" id="id" />
													<input type="hidden" value="1" name="quantity" id="quantity" />
												</form>
												<a class="add-to-cart pull-left" onclick="document.getElementById('addToCart{{$product->id}}').submit();"><i
															class="fa fa-shopping-cart"></i><span>Thêm giỏ hàng</span></a>
												<a class="beta-btn primary"
												   href="{{route('productDetail',$product->id)}}">Chi
													tiết <i class="fa fa-chevron-right"></i></a>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
							<div>{{$products['products']->appends(['p4' => $sale_products->currentPage(),'cate_id'=>$cate_id])->links()}}</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sản phẩm khác</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{$sale_products->total()}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($sale_products as $product)
									<div class="col-sm-4">
										<div class="single-item">
											<div class="ribbon-wrapper">
												<div class="ribbon sale">Sale</div>
											</div>

											<div class="single-item-header">
												<a href="{{route('productDetail',$product->id)}}"><img
															src="storage/products/{{$product->image_link}}" alt=""
															height="250"></a>
											</div>
											<div class="single-item-body">
												<p class="single-item-title">{{$product->name}}</p>
												<p class="single-item-price">
													@if($product->discount != 0)
														<span class="flash-del">{{number_format($product->price)}}
															VNĐ</span><br>
														<span class="flash-sale">{{number_format($product->price - (($product->price * $product->discount) / 100))}}
															VNĐ</span>
													@else
														<span class="flash-sale">{{number_format($product->price)}}
															VNĐ</span><br><br>
													@endif
												</p>
											</div>
											<div class="single-item-caption">
												<form method="POST" id="addToCart{{$product->id}}" action="{{route('themgiohang')}}" >
													{{ csrf_field() }}
													<input type="hidden" value="{{$product->id}}" name="id" id="id" />
													<input type="hidden" value="1" name="quantity" id="quantity" />
												</form>
												<a class="add-to-cart pull-left" onclick="document.getElementById('addToCart{{$product->id}}').submit();"><i
															class="fa fa-shopping-cart"></i><span>Thêm giỏ hàng</span></a>
												<a class="beta-btn primary"
												   href="{{route('productDetail',$product->id)}}">Chi tiết <i
															class="fa fa-chevron-right"></i></a>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								@endforeach
								<div>{{$sale_products->appends(['p5' => $sale_products->currentPage(),'cate_id'=>$cate_id])->links()}}</div>
							</div>
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>