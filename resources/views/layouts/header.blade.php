
<div id="header">
	<div class="header-top">
		<div class="container">
			<div class="pull-left auto-width-left">
				<ul class="top-menu menu-beta l-inline">
				</ul>
			</div>
			<div class="pull-right auto-width-right">
				<ul class="top-details menu-beta l-inline">
					@if(\Illuminate\Support\Facades\Auth::check())
						<li><a style="color: red" href="userProfile/{{\Illuminate\Support\Facades\Auth::user()->id}}">Tài Khoản:{{ \Illuminate\Support\Facades\Auth::user()->username }}</a></li>
						<li><a href="auth/logout">Đăng Xuất</a></li>
					@else
					<li><a href="quanly">Quản lý gian hàng</a></li>
					<li><a href="register">Đăng kí</a></li>
					<li><a data-toggle="modal" data-target="#myModal">Đăng nhập</a></li>
					@endif
				</ul>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->

	</div> <!-- .header-top -->

	<div class="header-body">
		<div class="container beta-relative">
			<div class="pull-left">
				<a href="{{route('trangchu')}}" id="logo"><img src="source/assets/dest/images/pet_shop_logo.jpg" width="157px" height="100px" alt=""></a>
			</div>
			<div class="pull-right beta-components space-left ov">
				<div class="space10">&nbsp;</div>
				<div class="beta-comp">
					<form role="search" method="get" id="searchform" action="/">
						<input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
						<button class="fa fa-search" type="submit" id="searchsubmit"></button>
					</form>
				</div>
			<!--
					<div class="beta-comp">
						if(Session::has('cart'))
						<div class="cart">
							<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng
								{{--(@if(Session::has('cart')){{Session('cart')->totalQty}}--}}
			{{--@else Trống @endif)--}}
					<i class="fa fa-chevron-down"></i></div>
                    <div class="beta-dropdown cart-body">
                        foreach($product_cart as $product)
                        <div class="cart-item">
                            <a class="cart-item-delete" href="{route('xoagiohang',$product['item']['id'])}}"><i class="fa
									fa-times"></i></a>
									<div class="media">
										<a class="pull-left" href="#"><img src="source/image/product/{$product['item']['image']}}" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">{$product['item']['name']}}</span>
											<span class="cart-item-amount">{$product['qty']}}*<span>
											if($product['item']['promotion_price']==0){number_format($product['item']['unit_price'])}}
											else{number_format($product['item']['promotion_price'])}}
											endif</span></span>
										</div>
									</div>
								</div>
								endforeach
								<div class="cart-caption">
									<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{number_format(Session('cart')->totalPrice)}} VNĐ</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="{route('dathang')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						endif
						add cart -->
			</div>
		</div>
		<div class="clearfix"></div>
	</div> <!-- .container -->
</div> <!-- .header-body -->
<div class="header-bottom" style="background-color: #0277b8;">
	<div class="container">
		<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
		<div class="visible-xs clearfix"></div>
		<nav class="main-menu">
			<ul class="l-inline ov">
				<li><a href="{{route('trangchu')}}">Trang chủ</a></li>
				<li><a>Sản phẩm</a>
					<ul class="sub-menu">
						{{--@foreach($loai_sp as $loai)--}}
						{{--<li><a href="{{route('loaisanpham',$loai->id)}}">{{$loai->name}}</a></li>--}}
						{{--@endforeach--}}
						<li><a href="">Thú cưng</a></li>
						<li><a href="">Đồ dùng cho thú cưng</a></li>
						<li><a href="">Thức ăn cho thú cưng</a></li>
					</ul>
				</li>
				<li><a href="">Dịch vụ cho pet</a></li>
				<li><a href="">Nhà cung cấp</a></li>
				<li><a href="{{route('gioithieu')}}">Giới thiệu</a></li>
				<li><a href="{{route('lienhe')}}">Liên hệ</a></li>
			</ul>
			<div class="clearfix"></div>
		</nav>
	</div> <!-- .container -->
</div> <!-- .header-bottom -->
</div> <!-- #header -->