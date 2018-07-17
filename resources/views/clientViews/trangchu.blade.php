@extends('layouts.master')
@section('content')
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <div class="bannercontainer">
                <div class="banner">
                    <ul>
                    @foreach($slide as $sl)
                        <!-- THE FIRST SLIDE -->
                            <li data-transition="boxfade" data-slotamount="20" class="active-revslide"
                                style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined"
                                     data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined"
                                     data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined"
                                     data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined"
                                     data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined"
                                     data-oheight="undefined">
                                    <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover"
                                         data-bgposition="center center" data-bgrepeat="no-repeat"
                                         data-lazydone="undefined" src="source/image/slides/{{$sl->image}}"
                                         data-src="source/image/slides/{{$sl->image}}"
                                         style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('source/image/slides/{{$sl->image}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="tp-bannertimer"></div>
        </div>
    </div>
    <!--slider-->
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Danh sách thú nuôi</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{$pet_products->total()}} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <!-- hien thi list sam pham moi -->
                                @foreach($pet_products as $product)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            @if($product->discount != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('chitietsanpham',1)}}"><img
                                                            src="source/image/products/{{$product->image_link}}" alt=""
                                                            height="250"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$product->name}}</p>
                                                <p class="single-item-price">
                                                    @if($product->discount != 0)
                                                    <span class="flash-del">{{$product->price}}
                                                        VNĐ</span><br>
                                                    <span class="flash-sale">{{($product->price * $product->discount) / 100}}
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
                                                            class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary"
                                                   href="{{route('chitietsanpham',$product->id)}}">Chi
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
                            <h4>Danh sách đồ dùng cho thú nuôi</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy 8 sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @for($i = 1; $i <= 8; $i++)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>

                                            <div class="single-item-header">
                                                <a href="{{route('chitietsanpham',1)}}"><img
                                                            src="source/image/product/pet_demo.jpg" alt=""
                                                            height="250"></a>
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
                                                <a class="add-to-cart pull-left" href="shopping_cart.html"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary"
                                                   href="{{route('chitietsanpham',1)}}">Chi tiết <i
                                                            class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                                <div class="row"><!-- links --></div>
                            </div>

                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div>
@endsection