@extends('ModeratorView.master')
@section('contentManager')
    <link href="source/assets/manage/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @if(!empty(\Illuminate\Support\Facades\Session::get('message')))
        @include('sweet::alert')
    @endif
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Chi tiết báo cáo</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('moderator_manage_place')}}">Trang Chủ</a>
                    </li>
                    <li>
                        <a>Quán lí báo cáo</a>
                    </li>
                    <li class="active">
                        <strong>Chi tiết báo cáo</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">

                    <div class="ibox product-detail">
                        <div class="ibox-content">

                            <div class="row">
                                <form action="{{route('reportProcess',$data['report']->id)}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="col-md-12">

                                    <h2 class="font-bold m-b-xs" style="color: #00A8FF">
                                        Đang xử lý báo cáo số: {{ $data['report']->id }}
                                    </h2>
                                    <br>
                                    <h4></h4>
                                    <h4 >Người Báo Cáo: <span style="color: #00A8FF">{{$data['user']->name}}. ID: {{ $data['user']->id }}</span> </h4>
                                    <h4>Nội Dung Báo Cáo: <span style="color: #00A8FF;">{{ $data['report']->description }}</span></h4>
                                    <h4>Trạng Thái:
                                        @if($data['report']->status ==1)
                                            <span style="color: #3dc7ab">Chưa Xử Lý</span>
                                            @endif
                                        @if($data['report']->status ==2)
                                            <span style="color: green;">Đúng</span>
                                            @endif
                                        @if($data['report']->status ==3)
                                            <span style="color: red;">Sai</span>
                                        @endif
                                    </h4>
                                    <hr>
                                    @if($data['report']->product_id != '')
                                    <h4>Sản Phẩm Bị Báo Cáo: <a target="_blank" href="{{route('productDetail',$data['report']->product_id)}} ">Link Sản Phẩm</a></h4>
                                        <hr>
                                    @endif
                                    <h4>Nhà Cung Cấp Bị Báo Cáo: <a target="_blank" href="{{route('detailSupplier',$data['report']->user_id)}}">Link Nhà Cung Cấp</a></h4>
                                    <div>
                                        <div class="btn-group">
                                            <button name="button" value="accept" class="btn btn-primary btn-sm"><i class="fa fa-cart-plus"></i>Chấp Nhận</button>
                                            <span style="margin-left: 10px"><button name="button" value="cancel" class="btn btn-danger btn-sm"><i class="fa fa-cart-plus"></i>Từ Chối</button></span>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

@endsection