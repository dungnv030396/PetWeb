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
                        @if(\Illuminate\Support\Facades\Auth::user()->roleId ==3)
                            <li><a href="#">Đăng ký bán hàng</a></li>
                        @else
                            <li><a href="#">Quản lý gian hàng</a></li>
                        @endif
                        <li><a style="color: red" href="userProfile/{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                @if(str_contains(\Illuminate\Support\Facades\Auth::user()->avatar,'https://graph.facebook.com') OR str_contains(\Illuminate\Support\Facades\Auth::user()->avatar,'googleusercontent.com'))

                                    <img src="{{\Illuminate\Support\Facades\Auth::user()->avatar }}" width="30px" height="30px">

                                @else
                                <img src="{{'storage/avatar/'.\Illuminate\Support\Facades\Auth::user()->avatar }}" width="30px"
                                     height="30px">
                                @endif
                                Email: @if(strlen(\Illuminate\Support\Facades\Auth::user()->email)>9)
                                    {{ substr(\Illuminate\Support\Facades\Auth::user()->email,0,6). "". '...' }}
                                @else
                                    {{ \Illuminate\Support\Facades\Auth::user()->email }}</a></li>
                    @endif
                    @if (session('facebook'))
                        <li><a href="logout/facebook">Đăng Xuất</a></li>
                    @else
                        <li><a href="auth/logout">Đăng Xuất</a></li>
                    @endif
                    @else
                        <li><a href="register">Đăng kí</a></li>
                        <li><a href="" data-toggle="modal" data-target="#myModal">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="{{route('trangchu')}}" id="logo"><img src="source/assets/dest/images/pet_shop_logo.jpg"
                                                               width="157px" height="100px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="/">
                        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..."/>
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>
                <div class="beta-comp">
                    <div class="cart">
                        @if(Session::has('cart'))
                            <div class="beta-select"><i class="fa fa-shopping-cart"></i>
                                Giỏ hàng(
                                @if(Session::has('cart'))
                                    {{Session('cart')->totalQuantity}}
                                @else
                                    0)
                                @endif
                                <i class="fa fa-chevron-down"></i></div>
                            <div class="beta-dropdown cart-body">
                                @foreach($cart_products as $product)
                                    <div class="cart-item">
                                        <a class="cart-item-delete"
                                           href="{{route('xoagiohang',$product['item']->id)}}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <div class="media">
                                            <a class="pull-left" href="#">
                                                <img src="source/image/products/{{$product['item']->image_link}}"
                                                     alt="">
                                            </a>
                                            <div class="media-body">
                                                <span class="cart-item-title">{{$product['item']->name}}</span>
                                                <span class="cart-item-amount">{{$product['quantity']}}*<span>
											@if($product['item']['discount'] != 0)
                                                            {{ number_format($product['item']->price - (($product['item']->price * $product['item']->discount) / 100))}}
                                                        @else
                                                            {{ number_format($product['item']['price'])}}
                                                        @endif
                                            </span></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="cart-caption">
                                    <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{number_format($amount)}}
                                            VNĐ</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="center">
                                        <div class="space10">&nbsp;</div>
                                        <a href="" class="beta-btn primary text-center">Đặt hàng <i
                                                    class="fa fa-chevron-right"></i></a>
                                        {{--{{route('dathang')}}--}}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="beta-select"><i class="fa fa-shopping-cart"></i>
                                Giỏ hàng (0)
                                <i class="fa fa-chevron-down"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span>
                <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{route('trangchu')}}">Trang chủ</a></li>
                    @foreach($catalogs as $catalog)
                        <li>
                            <a href="{{route('sanphamtheoloai',['cata_id'=>$catalog->id,'cate_id'=>null])}}">{{$catalog->name}}</a>
                            <ul class="sub-menu">
                                @foreach($catalog->categories as $category)
                                    <li>
                                        <a href="{{route('sanphamtheoloai',['cata_id'=>$catalog->id,'cate_id'=>$category->id])}}">{{$category->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                    <li><a href="{{ route('listSupplier') }}">Nhà cung cấp</a></li>
                    <li><a href="{{route('gioithieu')}}">Giới thiệu</a></li>
                    <li><a href="{{route('lienhe')}}">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->