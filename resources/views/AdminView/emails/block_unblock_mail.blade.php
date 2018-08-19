<link href="css/css-mail.css" rel="stylesheet">
<h1 class="main-head"> The Pet Family</h1>

<div class="main-conten">
    <p>Xin Chào {{ $name }}</p>
    <p>Chúng tôi xin thống báo cho bạn rằng: </p>
    <h4>Tài khoản:</h4>
    <p>Email: {{$email}}</p>
    <p>Họ tên: {{ $name }}</p>
    <p>Số điện thoại: {{ $phone }}</p>
    <p>Địa chỉ: {{ $address }}</p>
    <p>Chức vụ: {{$role}}</p>
    @if($type==1)
        <p class="text-danger">Của quý khách đã bị khóa vào lúc {{ $blocked_at }}</p>
    @else
        <p class="text-danger">Của quý khách đã được mở khóa vào lúc {{ $unblocked_at }}</p>
    @endif
    <h4 style="color: #0d8ddb">Nếu quý khách có gì thắc mắc xin liên hệ với công ty của chúng tôi. SĐT: 01697161671
        Xin cảm ơn!
    </h4>
</div>


