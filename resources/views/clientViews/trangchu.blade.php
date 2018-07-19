@extends('layouts.master')
@section('content')
@include('clientViews.slide')
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list" id="tag_container">
                            <h4>Danh sách thú nuôi</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{$pet_products->total()}} sản phẩm</p>
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
                                                            src="source/image/products/{{$product->image_link}}" alt=""
                                                            height="250"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$product->name}}</p>
                                                <p class="single-item-price">
                                                    @if($product->discount != 0)
                                                        <span class="flash-del">{{$product->price}}
                                                            VNĐ</span><br>
                                                        <span class="flash-sale">{{$product->price - (($product->price * $product->discount) / 100)}}
                                                            VNĐ</span>
                                                    @else
                                                        <span class="flash-sale">{{$product->price}}
                                                            VNĐ</span><br><br>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                   href="RoutesAddcart"><i
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
                            <div class="row">{{ $pet_products->links() }}</div>
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
                                                            src="source/image/products/{{$product->image_link}}" alt=""
                                                            height="250"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$product->name}}</p>
                                                <p class="single-item-price">
                                                    @if($product->discount != 0)
                                                        <span class="flash-del">{{$product->price}}
                                                            VNĐ</span><br>
                                                        <span class="flash-sale">{{$product->price - (($product->price * $product->discount) / 100)}}
                                                            VNĐ</span>
                                                    @else
                                                        <span class="flash-sale">{{$product->price}}
                                                            VNĐ</span><br><br>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                   href="RoutesAddcart"><i
                                                            class="fa fa-shopping-cart"></i><span>Thêm giỏ hàng</span></a>
                                                <a class="beta-btn primary"
                                                   href="{{route('productDetail',$product->id)}}">Chi tiết <i
                                                            class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row">{{$sale_products->links()}}</div>
                            </div>

                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div>
@endsection