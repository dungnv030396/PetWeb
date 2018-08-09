@extends('SupplierView.productManagement')
@section('contentManager')
    <link href="css/css-detail-add-product.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <!DOCTYPE html>
    <html lang="en">
    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>

    <div class="container">
        <div class="pull-left">
            <h2 style="color: #00bfff" class="inner-title">Chúc Mừng Bạn Đã Đăng Bán Thành Công</h2>
        </div>
        <br>
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-5">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="storage/products/{{$id['image_link']}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="details col-md-6">
                        <h3 style="color: #f90" class="inner-title">Thông tin chi tiết của sản phẩm</h3>
                        <br>
                        <h1 class="product-title">{{ $id['name'] }}</h1>
                        <p class="product-description">Mô Tả: {{ $id['description'] }}.</p>
                        @if($id['discount'] != 0)
                            <h4 class="price">Giá Cũ: <span>{{ number_format($id['price']) }} VND</span></h4>
                            <h4 class="price">Giá Hiện Tại: <span>{{ number_format($id['price'] - (($id['price'] * $id['discount']) / 100)) }} VND</span></h4>
                        @else
                            <h4 class="price">Giá Hiện Tại: <span>{{ number_format($id['price']) }} VND</span></h4>
                        @endif
                        <h4 class="price">Số Lượng: <span>{{ $id['quantity'] }}</span></h4>
                        <h5 class="inner-title">Đây là link sản phẩm của bạn trên kệ: <a href="chi-tiet-san-pham/{{$id['id']}}">Link sản phẩm</a></h5>
                        {{--<h4 class="price">Giá Cũ: <span>{{ number_format($id['price']) }}</span></h4>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>

@endsection