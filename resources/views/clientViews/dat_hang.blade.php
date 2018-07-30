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
				<h2 class="inner-title main-color">Đặt hàng</h2>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<h4 class="main-color"><a href="index" class="main-color" >Trang chủ</a> / <span>Đặt hàng</span></h4>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<form method="post" class="beta-form-checkout" enctype="multipart/form-data" action="{{route('checkout')}}" >
				{{ csrf_field() }}
				<div class="row">
					<div class="col-sm-6">
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="name"><b>Họ tên*</b></label>
							<input type="text" id="name" name="name" placeholder="Họ tên" value="{{$currentUser->name}}" required>
						</div>
						<div class="form-block">
							<label><b>Giới tính</b></label>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nam" {{ ($currentUser->gender == 1) ? 'checked' : '' }} style="width: 10%"><span style="margin-right: 10%">Nam</span>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nữ"  {{ ($currentUser->gender == 1) ? '' : 'checked' }} style="width: 10%"><span>Nữ</span>
										
						</div>

						<div class="form-block">
							<label for="email"><b>Email*</b></label>
							<input type="email" id="email" name="email" value="{{$currentUser->email}}" required placeholder="Điền địa chỉ email của bạn">
						</div>

						<div class="form-block">
							<label for="adress"><b>Địa chỉ*</b></label>
							<input type="text" id="address" name="address" {{$currentUser->address}} placeholder="Điền địa chỉ của bạn" required>
						</div>

						<div class="form-block">
							<label for="adress"><b>Địa chỉ nhận hàng(Nếu có)</b></label>
							<input type="text" id="address" name="order_address" {{$currentUser->address}} placeholder="Chúng tôi sẽ giao hàng đến địa chỉ trên nếu trống" >
						</div>


						<div class="form-block">
							<label for="phone"><b>Điện thoại*</b></label>
							<input type="text" id="phone" name="phone" value="{{$currentUser->phoneNumber}}" required placeholder="Điền số điện thoại của bạn">
						</div>
						
						<div class="form-block">
							<label for="notes"><b>Ghi chú</b></label>
							<textarea id="notes" name="notes"></textarea>
						</div>
						<div class="form-group">

							@include('layouts.errors')

						</div>
					</div>
					<div class="col-sm-6">
						<div class="your-order">
							<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
							<div class="your-order-body" style="padding: 0px 10px">
								<div class="your-order-item">
									<div>
									<!--  one item	 -->
										@if(Session::has('cart'))
											@foreach($cart->items as $product)
											<div class="media">
												<img width="25%" src="source/image/products/{{$product['item']->image_link}}" alt="" class="pull-left">
												<div class="media-body">
													<p class="font-large">{{$product['item']->name}}</p>
													<span class="color-gray your-order-info">Giá:
														@if($product['item']->discount != 0)
															{{number_format($product['item']->price - (($product['item']->price * $product['item']->discount) / 100))}}đ
														@else
															{{number_format($product['item']->price)}}đ
														@endif
													</span>
													<span class="color-gray your-order-info">Số lượng:
														<input class="qty-input1" id="quantity" name="quantity{{$product['item']->id}}" type="number" value="{{$product['quantity']}}" max="{{$product['item']->quantity}}" min="1"/>
													</span>
													<span class="color-gray your-order-info">Tổng: {{number_format($product['amountOfLine'])}}đ</span>
												</div>
											</div>
											@endforeach
										@endif
									<!-- end one item -->
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
									<div class="pull-right"><h5 class="your-order-item beta-sales-price">{{number_format($cart->totalPrice)}}đ</h5></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
							
							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="" name="payment">
										<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
										</div>						
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="" name="payment">
										<label for="payment_method_cheque">Chuyển khoản </label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											@include('clientViews.payment')
										</div>
										<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
										<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
									</li>
									
								</ul>
							</div>

							<div class="text-center"><button class="beta-btn primary" type="submit">Đặt hàng<i class="fa fa-chevron-right"></i></button></div>
						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
	@endsection