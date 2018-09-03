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
					<a href="{{route('trangchu')}}">Home</a> / <span>Sản phẩm</span>
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
								<li><a href="{{route('sanphamtheoloai',['cata_id'=>$catalog->id,'cate_id'=>null])}}"><b style="font-size: medium">{{$catalog->name}}</b></a><span style="font-size: medium">({{$catalog->categories->count()}})</span>&nbsp;
									<a onclick="displayHide(this,'hide{{$catalog->id}}','ulDisplay{{$catalog->id}}')" name="display{{$catalog->id}}"><span class="glyphicon glyphicon-plus" id="display{{$catalog->id}}"></span></a>
									<a onclick="displayDisplay(this,'display{{$catalog->id}}','ulDisplay{{$catalog->id}}')" name="hide{{$catalog->id}}"><span class="glyphicon glyphicon-minus" id="hide{{$catalog->id}}" style="display: none"></span></a>
									<ul id="ulDisplay{{$catalog->id}}" style="display: none">
										@foreach($catalog->categories as $category)
											<li><a href="{{route('sanphamtheoloai',['cata_id'=>$catalog->id,'cate_id'=>$category->id])}}">{{$category->name}} </a></li>
										@endforeach
									</ul>

								</li>

							@endforeach
								<li><b style="font-size: medium">Dịch vụ theo
										<form action="{{route('sanphamtheoloaiSapxep')}}" method="POST">
											{{csrf_field()}}
											<select class="form-control" name="select_sort" onchange="submit()">
												<option value="1" {{$selected == 1?'selected':''}}>Ngày đăng</option>
												<option value="2" {{$selected == 2?'selected':''}}>Giá tăng dần</option>
												<option value="3" {{$selected == 3?'selected':''}}>Giá giảm dần</option>
											</select>
											<input type="hidden" name="cata_id" value="{{$cata_id}}">
											<input type="hidden" name="cate_id" value="{{$cate_id}}">
										</form>
									</b>
								</li>


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
															VNĐ</span>
													@endif
												</p>
												<p class="single-item-title" style="color: #34ce57"><strong>Địa chỉ: {{$product->user->address}}</strong></p>
											</div>
											<div class="single-item-caption">
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
													<input type="hidden" value="{{$product->id}}" name="id"/>
													<input type="hidden" value="1" name="quantity"/>
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
<script type="text/javascript" language="javascript">
    function displayHide(d,hide,ul){
        document.getElementById(d.name).style.display = 'none';
        document.getElementById(hide).style.display = 'inline';
        document.getElementById(ul).style.display = 'block'
    }
    function displayDisplay(d,display,ul){
        document.getElementById(d.name).style.display = 'none';
        document.getElementById(display).style.display = 'inline';
        document.getElementById(ul).style.display = 'none'
    }
</script>