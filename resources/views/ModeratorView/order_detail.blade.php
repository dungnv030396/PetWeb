@extends('ModeratorView.master')
@section('contentManager')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @if(!empty(\Illuminate\Support\Facades\Session::get('message')))
        @include('sweet::alert')
    @endif
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Thông tin chi tiết đơn hàng</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Quản Lý Đơn Hàng</a>
                </li>
                <li>
                    Đơn hàng
                </li>
                <li class="active">
                    <strong>Chi tiết</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                <a href="{{route('printOrder',$order->id)}}" target="_blank" class="btn btn-primary"><i
                            class="fa fa-print"></i> In đơn hàng </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>From:</h5>
                            <address>
                                <strong>The Pet Family, Inc.</strong><br>
                                Kho 1<br>
                                Địa chỉ<br>
                                <abbr title="Phone">P:</abbr> 01697161671
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
                            <span><h4>Tình trạng đơn hàng</h4> <h4 class="text-navy">{{$order->status['stt']}}</h4></span>
                            @if($order->moderator)
                                <span><h4>Người quản lý</h4><a><h4 class="text-navy">{{$order->moderator['name']}}</h4></a> </span>
                            @endif


                        </div>
                    </div>

                    <div class="table-responsive m-t">
                        <table class="table invoice-table">
                            <thead>
                            <tr>
                                <th>Danh sách sản phẩm</th>
                                <th>Nhà cung cấp</th>
                                <th>Trạng thái</th>
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
                                    <td><strong><a href="#">{{$line->product->user->name}}</a></strong></td>
                                    <td class="text-warning">{{$line->status['stt']}}</td>
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
                    <div class="text-right">
                        <div class="space-30"></div>
                        @if($order->status->id==1)
                            <a class="btn btn-primary" href="{{route('orderAssign',$order->id)}}">Nhận quản lý</a>
                        @elseif($order->status->id > 1 && $order->status->id < 5)
                            @if($order->moderator->id == \Illuminate\Support\Facades\Auth::user()->id)
                                <a class="btn btn-primary" href="{{route('orderAssignDelete',$order->id)}}">Bỏ quản
                                    lý</a>
                                <a class="btn btn-primary" href="{{route('orderDelete',$order->id)}}">Hủy đơn hàng</a>
                            @endif
                        @endif
                        @if($order->status->id==4)
                            <button class="btn btn-primary">Hoàn thành đơn hàng</button>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="source/assets/dest/js/DateFormat/dateformat.min.js"></script>

@endsection
