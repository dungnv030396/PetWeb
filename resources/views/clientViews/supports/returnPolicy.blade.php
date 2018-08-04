@extends('layouts.master')
@section('content')
    <link href="css/css-policy.css" rel="stylesheet">
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h2 class="inner-title main-color">Chính Sách Hoàn Trả</h2>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="index">Trang Chủ</a> / <span>Chính sách hoàn trả</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="first-div">
        <h4>I. Quý khách có thể hoàn trả hàng đã mua trong các trường hợp sau:</h4>
        <br>
        <h4>1. Đối với thú nuôi</h4>
        <ul class="square">
            <li class="text-size">Thú nuôi có triệu chứng bệnh có trong <a href="{{Route('guarantee')}}">danh sách bảo hành</a></li>
            <li class="text-size">Thú nuôi không chính xác với hình ảnh của nhà cung cấp VD: trọng lượng,tuổi,màu,....
            </li>
        </ul>
        <p class="text-size">Thời hạn đổi hàng : 07 ngày kể từ ngày nhận hàng</p>
        <h4>2. Đối với sản phẩm</h4>
        <ul class="square">
            <li class="text-size">Hàng có lỗi kỹ thuật do nhà sản xuất.</li>
            <li class="text-size">Hàng bị giao nhầm, nhầm size.</li>
        </ul>
        <p class="text-size">Thời hạn hoàn trả hàng : 05 ngày kể từ ngày mua/nhận hàng</p>
        <br>
        <h4>II. Điều kiện đổi hàng:</h4>
        <br>
        <h4>1. Đối với thú nuôi</h4>
        <ul class="square">
            <li class="text-size">Thú nuôi không bị tổn thương thêm so với lúc giao hàng</li>
            <li class="text-size">Nếu thú nuôi có tổn thương so với lúc nhận hàng, người mua sẽ chịu hoàn toàn chi phí</li>
        </ul>
        <h4>2. Đối với sản phẩm</h4>
        <br>
        <ul class="square">
            <li class="text-size">Hàng chưa qua sử dụng, giặt ủi, phải còn nguyên tem mác, không dính bẩn,…</li>
        </ul>
        <h4>III. Phí đổi hàng:</h4>
        <br>
        <ul class="square">
            <li class="text-size">Nếu hàng bị lỗi kỹ thuật do nhà sản xuất hoặc thú nuôi có lỗi do nhà cung cấp: miễn phí toàn bộ phí chuyển hàng (gửi trả và giao hàng)</li>
            <li class="text-size">Trường hợp khác Quý khách hàng sẽ chịu chi phí chuyển hàng (gửi trả và giao hàng).</li>
        </ul>
        <p class="text-size"><i>Xin Quý Khách Hàng lưu ý: Chúng tôi không hỗ trợ Quý khách trả lại hàng hoặc thú nuôi khi không đủ các điều kiện trên.</i></p>
        <br>
        <h3><b>Chân thành cảm ơn Quý khách đã quan tâm đến các sản phẩm nhãn hiệu The Pet Family</b></h3>
    </div>
@endsection