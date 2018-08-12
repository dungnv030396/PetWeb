<link href="css/css-mail.css" rel="stylesheet">
<h1 class="main-head"> The Pet Family</h1>

<div class="main-conten">
    {{--@foreach($data['data'] as $item)--}}
        {{--<p>{{ $item['email'] }}</p>--}}
    <p>Xin Chào {{ $supplier_name }}</p>
    <p>Hiện tai sản phẩm của bạn đã được đặt hàng:</p>
    <h4>Thông tin sản phẩm</h4>
    <p>Mã Sản Phẩm: {{ $orderLine_id }}</p>
    <p>Tên: {{ $product_name }}</p>
    <p>Giá: {{ $price }}</p>
    <p>Số Lượng: {{$quantity}}</p>
    <p>Tổng Tiền: {{ $amount }}</p>
    {{--@endforeach--}}
    <h4 style="color: #0d8ddb">Xin mời bạn kiểm tra đơn hàng trên website hoặc liên hệ để vận chuyển tới kho</h4>
</div>


