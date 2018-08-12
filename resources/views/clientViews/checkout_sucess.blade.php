@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="source/assets/dest/js/DateFormat/dateformat.min.js"></script>
    @if(!empty($message))
        @include('sweet::alert')
    @endif
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h2 class="inner-title main-color">Đặt hàng</h2>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <h4 class="main-color"><a href="index" class="main-color">Trang chủ/Đặt hàng</a> /Thành
                        công<span></span></h4>
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

                            <label><b>Khách hàng: </b>
                            </label><span>  {{($user->gender==1)?'Anh':'Chị'}} {{$user->name}}</span>
                            <br>
                            <label><b>Email: </b></label><span> {{$user->email}}</span>
                            <br>

                            <label><b>Địa chỉ nhận hàng: </b></label> <span> {{$order->address}}</span>
                            <br>

                            <label><b>Số điện thoại nhận hàng: </b></label>
                            <span> {{$user->phoneNumber}}</span>
                            <br>
                            <label><b>Thời gian đặt hàng: </b></label>
                            <span id="orderTime"><script> document.getElementById("orderTime").innerHTML = formatDate('{{$order->created_at}}','hh:mm:ss dd/MM/yyyy a');</script></span>
                            <br>
                            <label><b>Phí vận chuyển: </b></label><span> 30,000đ</span>
                            <br>
                            <label><b>Ghi chú: </b></label><span> {{$order->payment->user_message}}</span>
                            <br>
                            <br>
                            <span style="color: #0000FF">Nhân viên của chúng tôi sẽ gọi cho quý khách và xác nhận đơn hàng trong thời gian sớm nhất!
                            Cảm ơn quý khách đã mua hàng của chúng tôi!!!
                            </span>
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
                                    @foreach($order->orderLine as $oderLine)
                                        <div class="media">
                                            <img width="20%"
                                                 src="storage/products/{{$oderLine->product->image_link}}" alt=""
                                                 class="pull-left">
                                            <div class="media-body">
                                                <p class="font-large">{{$oderLine->product->name}}</p>
                                                <span class="color-gray your-order-info">Giá:
                                                    @if($oderLine->product->discount != 0)
                                                        {{number_format($oderLine->product->price - (($oderLine->product->price * $oderLine->product->discount) / 100))}}
                                                        đ
                                                    @else
                                                        {{number_format($oderLine->product->price)}}đ
                                                    @endif
													</span>
                                                <span class="color-gray your-order-info">Số lượng: {{$oderLine->quantity}}
													</span>
                                                <span class="color-gray your-order-info">Tổng: {{number_format($oderLine->amount)}}
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
                                            class="your-order-item beta-sales-price">{{number_format($order->payment->amount)}}
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