@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="source/assets/dest/js/DateFormat/dateformat.min.js"></script>
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h2 class="inner-title main-color">Chi Tiết Đơn Hàng</h2>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <h4 class="main-color"><a href="index" class="main-color">Trang chủ/Lịch sử mua hàng</a> /Chi tiết đơn hàng<span></span></h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-6">

                    <div class="your-order">
                        <div class="your-order-head"><h5>Thông tin đặt hàng</h5></div>
                        <div class="space-25"></div>
                        <div class="your-order-body" style="padding: 0px 10px">
                            @foreach($orderDetail['user_info'] as $item)
                            <label><b>Khách hàng: </b>
                            </label><span> {{$item['customer_name']}} </span>
                            <br>
                            <label><b>Email: </b></label><span> {{$item['email']}}</span>
                            <br>

                            <label><b>Địa chỉ nhận hàng: </b></label> <span> {{$item['address']}}</span>
                            <br>

                            <label><b>Số điện thoại nhận hàng: </b></label>
                            <span> {{$item['phonenumber']}}</span>
                            <br>
                            <label><b>Thời gian đặt hàng: </b></label>
                            <span id="orderTime"><script> document.getElementById("orderTime").innerHTML = formatDate('{{$item['created_at']}}','hh:mm:ss dd/MM/yyyy a');</script></span>
                            <br>
                            <label><b>Phí vận chuyển: </b></label><span> 30,000đ</span>
                            <br>
                            <label><b>Ghi chú: </b></label><span>{{$item['description']}} </span>
                            <br>
                            <br>
                                @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="your-order">
                        <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                        <div class="your-order-body" style="padding: 0px 10px">
                            <div class="your-order-item">
                                <div>
                                    <!--  one item	 -->
                                    @foreach($orderDetail['detailOrder'] as $oderLine)
                                        <div class="media">
                                            <img width="20%"
                                                 src="source/image/products/{{$oderLine['image_link']}}" alt=""
                                                 class="pull-left">
                                            <div class="media-body">
                                                <p class="font-large">{{$oderLine['product_name']}}</p>
                                                <span class="color-gray your-order-info">Giá:
                                                    @if($oderLine['discount'] != 0)
                                                        {{number_format($oderLine['price'] - (($oderLine['price']* $oderLine['discount']) / 100))}}
                                                        đ
                                                    @else
                                                        {{number_format($oderLine['price'])}}đ
                                                    @endif
													</span>
                                                <span class="color-gray your-order-info">Số lượng: {{$oderLine['quantity']}}
													</span>
                                                <span class="color-gray your-order-info">Tổng: {{number_format($oderLine['amount'])}}
                                                    đ</span>
                                            </div>
                                        </div>
                                @endforeach
                                <!-- end one item -->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="your-order-item">
                                <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                                <div class="pull-right"><h5
                                            @foreach($orderDetail['user_info'] as $item)
                                            class="your-order-item beta-sales-price">{{number_format($item['total'])}}
                                        @endforeach
                                        đ</h5></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- .your-order -->

                </div>


            </div> <!-- #content -->
        </div> <!-- .container -->

@endsection