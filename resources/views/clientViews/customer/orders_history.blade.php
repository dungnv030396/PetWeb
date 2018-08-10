@extends('layouts.master')
@section('content')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <h2 class="main-color">Danh Sách Lịch Sử Mua Hàng</h2>
                <br>
                <h4>Tìm thấy <a style="color: #f90">{{ $listOrders['number'] }}</a> Lần Mua Hàng</h4>
                <form method="POST" action="{{route('searchOrderHistory')}}">
                    {{ csrf_field() }}
                    <span class="search-supplier"><input class="form-control form-control-lg form-control-borderless"
                                                         name="name" type="search" placeholder="Tìm kiếm Trạng Thái và Ngày Mua"></span>
                    <button class="button-search-supplier btn btn-success " type="submit">Tìm Kiếm</button>
                </form>
                <br>
                <div class="table-responsive">
                    @if($listOrders['allOrders']!=null)
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                        <th>Mã Đơn Hàng</th>
                        <th>Trạng Thái</th>
                        <th>Chi Tiết</th>
                        <th>Địa Điểm Nhận Hàng</th>
                        <th>Ngày Mua</th>
                        </thead>
                        @foreach($listOrders['allOrders'] as $item)
                            <tbody>
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td class="main-color">{{ $item['status'] }}</td>
                                <td><a href="{{route('detailOrders',$item['id'])}}">Xem Chi Tiết</a></td>
                                <td>{{ $item['address'] }}</td>
                                <td>{{ $item['created_at'] }}</td>
                            </tr>
                            </tbody>
                        @endforeach
                        @else
                            <h3>Bạn không có lịch sử mua hàng</h3>
                        @endif
                    </table>
                    <div class="row">{{$listOrders['orderPaginate']->links()}}</div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
@endsection