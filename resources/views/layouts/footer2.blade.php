<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="widget">
                    <h4 class="widget-title">LIÊN HỆ</h4>
                    <div>
                        <ul>
                            <li><a><i class="glyphicon glyphicon-home"></i>Đại Học FPT,xã Thạch Hòa huyện Thạch Thất TP
                                    Hà Nội</a></li>
                            <li><a><i class="glyphicon glyphicon-phone"></i>SDT: 0964133843</a></li>
                            <li><a><i class="glyphicon glyphicon-envelope"></i>Email: thepetfamilyteam@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="widget">
                    <h4 class="widget-title">TÀI KHOẢN CỦA BẠN</h4>
                    <div>
                        <ul>
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <li><a href="{{route('ordersHistory',\Illuminate\Support\Facades\Auth::user()->id)}}"><i
                                                class="fa fa-chevron-right"></i>Xem Lịch Sử Đơn
                                        Hàng</a></li>
                                @else
                                <li><a href="{{route('registerPage')}}"><i
                                                class="fa fa-chevron-right"></i>Xem Lịch Sử Mua
                                        Hàng</a></li>
                            @endif
                            <li><a href="{{Route('privacyPolicy')}}"><i class="fa fa-chevron-right"></i>Chính Sách Bảo
                                    Mật</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="col-sm-10">
                    <div class="widget">
                        <h4 class="widget-title">HỖ TRỢ</h4>
                        <div>
                            <ul>
                                <li><a href="{{ Route('lienhe') }}"><i class="fa fa-chevron-right"></i>Liên Hệ Hỗ
                                        Trợ</a></li>
                                <li><a href="{{ Route('returnPolicy') }}"><i class="fa fa-chevron-right"></i>Chính Sách
                                        Hoàn Trả</a></li>
                                <li><a href="{{Route('shoppingGuide')}}"><i class="fa fa-chevron-right"></i>Hướng Dẫn
                                        Mua Hàng</a></li>
                                <li><a href="{{Route('guarantee')}}"><i class="fa fa-chevron-right"></i>Chính Sách Bảo
                                        Hành</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="col-sm-10">
                    <div class="widget">
                        <h4 class="widget-title">VỀ THE PET FAMILY</h4>
                        <div>
                            <ul>
                                <li><a href="{{Route('gioithieu')}}"><i class="fa fa-chevron-right"></i>Giới Thiệu</a>
                                </li>
                                <li><a href="{{Route('recruitment')}}"><i class="fa fa-chevron-right"></i>Tuyển Dụng</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .row -->
</div> <!-- .container -->
</div> <!-- #footer -->