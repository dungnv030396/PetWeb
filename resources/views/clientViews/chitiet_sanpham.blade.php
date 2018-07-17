@extends('layouts.master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm Cho xinh</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trangchu')}}">Home</a> / <span>Thông tin chi tiết sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

<div class="container">
	<div id="content">
		<div class="row">
			<div class="col-sm-9">

				<div class="row">
					<div class="col-sm-4">
						<img src="source/image/product/pet_demo.jpg" alt="">
					</div>
					<div class="col-sm-8">
						<div class="single-item-body">
							<p class="single-item-title"><h3>Cho Xinh</h3></p>
							<p class="single-item-price">
                                                    <span class="flash-del">850000
                                                        VNĐ</span>
								<span class="flash-sale">700000
                                                        VNĐ</span>
							</p>
						</div>

						<div class="clearfix"></div>
						<div class="space20">&nbsp;</div>

						<div class="single-item-desc">
							<p>Chó Mỹ chất lượng cao</p>
						</div>
						<div class="space20">&nbsp;</div>

						<p>Số lượng:</p>
						<div class="single-item-options">
							<select class="wc-select" name="color">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<a class="add-to-cart" href="{{route('themgiohang',1)}}"><i class="fa fa-shopping-cart"></i></a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="space40">&nbsp;</div>
				<div class="woocommerce-tabs">
					<ul class="tabs">
						<li><a href="#tab-description">Mô tả sản phẩm</a></li>
					</ul>

					<div class="panel" id="tab-description">
						<p>Chó Mỹ chất lượng cao</p>
					</div>
					<div class="panel" id="tab-reviews">
						<p>No Reviews</p>
					</div>
				</div>
				<div class="space50">&nbsp;</div>
				<div class="beta-products-list">
					<h4>Sản phẩm tương tự</h4>
					<div class="row">
						@for($i = 1; $i <= 3; $i++)
						<div class="col-sm-4">
							<div class="single-item">
								@if(true)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
								<div class="single-item-header">
									<a href="{{route('chitietsanpham',1)}}"><img src="source/image/product/pet_demo.jpg" alt="" height="250"></a>
							</div>
								<div class="single-item-body">
									<p class="single-item-title">Cho xinh</p>
									<p class="single-item-price">
                                                    <span class="flash-del">850000
                                                        VNĐ</span>
										<span class="flash-sale">700000
                                                        VNĐ</span>
									</p>
								</div>
								<div class="single-item-caption">
									<a class="add-to-cart pull-left" href="#"><i class="fa fa-shopping-cart"></i></a>
									<a class="beta-btn primary" href="#">Details <i class="fa fa-chevron-right"></i></a>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						@endfor
					</div>
					<div class="row">{{$sp_tuongtu->links()}}</div>
				</div> <!-- .beta-products-list -->
			</div>
				<div class="widget">
					<h3 class="widget-title">Sản phẩm mới</h3>
					<div class="widget-body">
						<div class="beta-sales beta-lists">
							@for($i = 1; $i <= 9; $i++)
							<div class="media beta-sales-item">
								<a class="pull-left" href="{{route('chitietsanpham',1)}}"><img src="source/image/product/pet_demo.jpg" alt="" height="50"></a>
								<div class="media-body">
									Cho xinh {{$i}}
								</div>
								<div>
									<span class="beta-sales-price">700000 VNĐ</span>
								</div>
							</div>
							@endfor
						</div>
					</div>
				</div> <!-- best sellers widget -->
			</div>
		</div>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection