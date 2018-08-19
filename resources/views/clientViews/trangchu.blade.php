@extends('layouts.master')
@section('content')
@include('clientViews.slide')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
@if(!empty(\Illuminate\Support\Facades\Session::get('message')))
    @include('sweet::alert')
@endif
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list" id="tag_container">
                            <h2 style="color: #f90">Trang chủ</h2>
                            <div class="beta-products-details">
                                <h4 class="pull-left">Tìm thấy <a style="color: #f90"> {{$pet_products->total()}} </a>sản phẩm</h4>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach($pet_products as $product)
                                    <div class="col-sm-3">
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
                                                    <input type="hidden" value="{{$product->id}}" name="id" />
                                                    <input type="hidden" value="1" name="quantity" />
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
                            <!-- end -->
                            </div>
                            <div>{{ $pet_products->appends(['p1' => $pet_products->currentPage()])->links() }}</div>
                        </div> <!-- .beta-products-list -->
                        <div class="space50">&nbsp;</div>
                        <div class="beta-products-list">
                            <h4>Sản phẩm đang khuyến mại</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{$sale_products->total()}} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach($sale_products as $product)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>

                                            <div class="single-item-header">
                                                <a href="{{route('productDetail',$product->id)}}"><img
                                                            {{--src="source/image/products/{{$product->image_link}}" alt=""--}}
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
                                                <form method="POST" action="{{route('themgiohang')}}" >
                                                        {{ csrf_field() }}
                                                    <input type="hidden" value="{{$product->id}}" name="id" />
                                                    <input type="hidden" value="1" name="quantity" />
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
                                <div>{{$sale_products->appends(['p2' => $sale_products->currentPage()])->links()}}</div>
                            </div>

                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div>
@endsection