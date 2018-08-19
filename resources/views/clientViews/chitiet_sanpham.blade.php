@extends('layouts.master')
@section('content')
    @if(count($errors))
        <script>
//            $(function () {
//                console.log('run test')
//                $("#unactive").removeClass("active");
//                $("#active").toggleClass("active");
//                $("#tab-description").css("display", "none")
//                $("#tab-report").css("display", "block")
//            })
            $( document ).ready(function() {
                console.log( "ready!" );
                console.log('run test')
                $("#unactive").removeClass("active");
                $("#active").toggleClass("active");
                $("#tab-description").css("display", "none")
                $("#tab-report").css("display", "block")
            });
        </script>
    @endif
    @if(!empty(Session::get('reportSuccess')))
        <script>
            $(function () {
                $("#active").addClass("active");
            })
        </script>
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @if(!empty(\Illuminate\Support\Facades\Session::get('message2')))
        @include('sweet::alert')
    @endif
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Sản phẩm <b>{{$product['product']->name}}</b></h6>
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
                            <img src="storage/products/{{$product['product']->image_link}}" alt="">
                        </div>
                        <div class="col-sm-8">
                            <div class="single-item-body">
                                <p class="single-item-title">
                                <h3>{{$product['product']->name}}</h3></p>
                                <p class="single-item-price">
                                    @if($product['product']->discount != 0)
                                        <span class="flash-del">{{number_format($product['product']->price)}}
                                            VNĐ</span>
                                        <span class="flash-sale">{{number_format($product['product']->price - (($product['product']->price * $product['product']->discount) / 100))}}
                                            VNĐ</span>
                                    @else
                                        <span class="flash-sale">{{number_format($product['product']->price)}}
                                            VNĐ</span>
                                    @endif
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-desc">
                                <p></p>
                            </div>
                            <div class="space20"></div>
                            <p>Số lượng: </p>

                            <div class="single-item-options">
                                <form method="POST" name="addToCart" id="addToCart" action="{{route('themgiohang')}}" >
                                    {{ csrf_field() }}
                                    <div class="qty-changer">
                                        <input type="hidden" value="{{$product['product']->id}}" name="id" id="id" />
                                        <input class="qty-input form-group" id="quantity" name="quantity" type="number" value="1" max="{{$product['product']->quantity}}" min="1"/>
                                        <p>(Còn lại <b>{{$product['product']->quantity}}</b> sản phẩm)</p>
                                    </div>
                                </form>
                                @if(!empty(\Illuminate\Support\Facades\Session::get('message')))
                                    @include('sweet::alert')
                                @endif
                                @if(!empty(\Illuminate\Support\Facades\Session::get('messageReport')))
                                    @include('sweet::alert')
                                @endif

                                <a class="add-to-cart pull-left" onclick="document.getElementById('addToCart').submit();"><i
                                            class="fa fa-shopping-cart"></i><span>Thêm giỏ hàng</span></a>
                                {{--report--}}
                                {{--<div style="border: solid; width: 10vw;height: 3vw;margin-top: 3vw">--}}

                                {{--</div>--}}
                                {{--endreport--}}
                                <div class="clearfix"></div>
                            </div>
                            <div class="single-item-supplier">
                                <p>Người bán: <a href="{{Route('detailSupplier',$product['supplier']->id)}}">{{$product['supplier']->name}}</a></p>
                            </div>
                        </div>

                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li id="unactive"><a href="#tab-description">Mô tả sản phẩm</a></li>
                            <li><a href="#tab-reviews">Bình Luận({{$comments->total()}})</a></li>
                            <li><a href="#tab-addComment">Thêm Bình Luận</a></li>
                            <li id="active"><a href="#tab-report">Báo cáo sản phẩm</a></li>
                        </ul>

                        <div class="panel" id="tab-description">
                            <p>{{$product['product']->description}}</p>
                        </div>
                        <div class="panel" id="tab-reviews">
                            @include('clientViews.comment.comment')
                        </div>
                        <div class="panel" id="tab-addComment">
                            @include('clientViews.comment.addComment')
                        </div>
                        <div class="panel" id="tab-report">
                            @include('layouts.reportProduct')
                        </div>
                        @if(!empty(\Illuminate\Support\Facades\Session::get('reportSuccess')))
                            @include('sweet::alert')
                        @endif
                    </div>
                    <div class="space50">&nbsp;</div>
                    <div class="beta-products-list">
                        <h4>Sản phẩm tương tự</h4>
                        <div class="row">
                            @foreach($same_products as $product)
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
                        <div>{{$same_products->appends(['p3' => $same_products->currentPage()])->links()}}</div>
                    </div> <!-- .beta-products-list -->
                </div>
                <div class="widget">
                    <h3 class="widget-title">Sản phẩm mới</h3>
                    <div class="widget-body">
                        <div class="beta-sales beta-lists">
                            @foreach($new_products as $product)
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="{{route('productDetail',$product->id)}}"><img
                                                src="storage/products/{{$product->image_link}}" alt="" height="50"></a>
                                    <div class="media-body">
                                        {{$product->name}}
                                    </div>
                                    <div>
                                        <span class="beta-sales-price">{{number_format($product->price - (($product->price * $product->discount) / 100))}}
                                            VNĐ</span>
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
@endsection