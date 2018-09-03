<link href="css/css-mail.css" rel="stylesheet">
<h1 class="main-head"> The Pet Family</h1>


<div class="main-conten">
    <p>Xin Chào {{ $name }}</p>
    @if(empty($product_id))
        <p>Bạn đã báo cáo tài khoản:</p>
        <p>- Họ và Tên: {{ $reportTo_name }}</p>
        <p>Nội dung cáo báo:</p>
        <p style="color: red">- {{$des}}</p>
    @else
        <p>Bạn đã báo cáo sản phẩm:</p>
        <p>Link sản phẩm: <a href="{{ route('productDetail',$product_id) }}">Link</a></p>
        <p>Nội dung báo cáo là:</p>
        <p style="color: red">- {{ $des }}</p>
    @endif
    <h4 style="color: green;">Chúng tôi đã xem xét về báo cáo của bạn và nhận thấy báo cáo của bạn hoàn toàn chính xác,Chúng tôi sẽ có hình thức xử lý</h4>
</div>