<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Pet Family | Order Print</title>
    <link href="../../../public/source/assets/manage/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../public/source/assets/manage/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../../public/source/assets/manage/css/animate.css" rel="stylesheet">
    <link href="../../../public/source/assets/manage/css/style.css" rel="stylesheet">
</head>

<body class="white-bg">
<div class="wrapper wrapper-content p-xl">
    <div class="ibox-content p-xl">
        <div class="row">
            <div class="col-sm-6">
                <h5>From:</h5>
                <address>
                    <strong>The Pet Family, Inc.</strong><br>
                    Kho: {{$order->warehouse->name}}<br>
                    Địa chỉ: {{$order->warehouse->address}}<br>
                    <abbr title="Phone">P: </abbr> 01697161671
                </address>
            </div>

            <div class="col-sm-6 text-right">
                <h4>Đơn hàng Số.</h4>
                <h4 class="text-navy">{{$order->id}}</h4>
                <span>To:</span>
                <address>
                    <strong>{{($order->user->gender==1?'Anh ':'Chị ')}}{{($order->user->name)}}</strong><br>
                    {{$order->address}}<br>
                    <abbr title="Phone">P:</abbr> {{($order->user->phoneNumber)}}
                </address>
                <p>
                    <span><strong>Ngày đặt hàng: </strong>{{$order->created_at->modify('+7 hours')->format('H:i:s d/m/Y')}}</span><br/>
                    <span><strong>Ngày giao hàng: </strong>{{$order->created_at->modify('+7 hours')->format('H:i:s d/m/Y')}}</span>
                </p>
                <div class="space-25"></div>

            </div>
        </div>

        <div class="table-responsive m-t">
        <table class="table invoice-table">
            <thead>
            <tr>
                <th>Danh sách sản phẩm</th>
                <th>Số Lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->orderLine as $line)
                <tr>
                    <td>
                        <div><strong><a href="#">{{$line->product->name}}</a></strong></div>
                    <td>{{$line->quantity}}</td>
                    <td>{{($line->product->discount != 0)?(number_format($line->product->price - (($line->product->price * $line->product->discount) / 100))):number_format($line->product->price)}}
                        đ
                    </td>
                    <td><strong>{{number_format($line->amount)}}đ</strong></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div><!-- /table-responsive -->

    <table class="table invoice-total">
        <tbody>
        <tr>
            <td><strong>Tổng giá sản phẩm :</strong></td>
            <td>{{number_format($order->payment->amount)}}đ</td>
        </tr>
        <tr>
            <td><strong>Ship :</strong></td>
            <td>30,000đ</td>
        </tr>
        <tr>
            <td><strong>TOTAL :</strong></td>
            <td><strong>{{number_format($order->payment->amount + 30000)}}đ</strong></td>
        </tr>
        </tbody>
    </table>

</div>

</div>

<!-- Mainly scripts -->
<script src="../../../public/source/assets/manage/js/jquery-2.1.1.js"></script>
<script src="../../../public/source/assets/manage/js/bootstrap.min.js"></script>
<script src="../../../public/source/assets/manage/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Custom and plugin javascript -->
<script src="../../../public/source/assets/manage/js/inspinia.js"></script>

<script type="text/javascript">
    window.print();
</script>

</body>

</html>
