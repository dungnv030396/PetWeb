<link href="css/css-mail.css" rel="stylesheet">
<h1 class="main-head"> The Pet Family</h1>


<div class="main-conten">
    <p>Xin Chào {{ $name }}</p>
    @if(empty($product_id))
        <p>Tài Khoản của bạn đã bị báo cáo với nội dung:</p>
        <p style="color: red"> {{$des}}</p>
    @else
        <p>Sản phẩm của bạn đã bị báo cáo với nội dung:</p>
    <p style="color: red"> {{ $des }}</p>
    <p>Link sản phẩm: <a href="{{ route('productDetail',$product_id) }}">Link</a></p>
    @endif
    <h4>Bạn hãy chú ý với những nội dung đã bị báo cáo! nếu còn tiếp diễn chúng tôi sẽ tiến hành khóa tài khoản</h4>
</div>