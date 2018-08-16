@extends('AdminView.master')
@section('contentManager')
    <link href="source/assets/manage/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">

        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">Thông Tin Phiếu Đăng Ký Số: <b>{{ $res->id }}</b></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <form method="post" action="{{route('registrationProcessing',$res->id)}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <fieldset class="form-horizontal">
                                        <div class="form-group"><label class="col-sm-2 control-label">Họ và tên:</label>
                                            <div class="col-sm-10"><input type="text" class="form-control" required value="{{$res->name}}" readonly></div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Giới Tính:</label>
                                            <div class="col-sm-10">
                                                @if($res->gender == '1')
                                                    <label>
                                                        <input name="gender" type="radio" value="1" checked>
                                                        Nam </label>
                                                       
                                                    <label>
                                                        <input name="gender" type="radio" value="0">
                                                        Nữ </label>
                                                @else
                                                    <label>
                                                        <input name="gender" type="radio" value="1">
                                                        Nam </label>
                                                       
                                                    <label>
                                                        <input name="gender" type="radio" value="0" checked>
                                                        Nữ </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Email:</label>
                                            <div class="col-sm-10"><input type="text" class="form-control"
                                                                          required value="{{$res->email}}" readonly></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Số Điện Thoại:</label>
                                            <div class="col-sm-10"><input type="text" class="form-control"
                                                                           required value="{{$res->phoneNumber}}" readonly></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Địa Chỉ:</label>
                                            <div class="col-sm-10"><input  type="text" class="form-control"
                                                                         required value="{{$res->address}}" readonly></div>
                                        </div>
                                        <hr>
                                        <div class="form-group"><label class="col-sm-2 control-label">Tên Ngân Hàng:</label>
                                            <div class="col-sm-10"><input  type="text" class="form-control"
                                                                           required value="{{$res->bank_name}}" readonly></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Số Tài Khoản:</label>
                                            <div class="col-sm-10"><input  type="text" class="form-control"
                                                                           required value="{{$res->card_number}}" readonly></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Tên Chủ Tài Khoản:</label>
                                            <div class="col-sm-10"><input  type="text" class="form-control"
                                                                           required value="{{$res->bank_username}}" readonly></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Chi Nhánh:</label>
                                            <div class="col-sm-10"><input  type="text" class="form-control"
                                                                           required value="{{$res->bank_branch}}" readonly></div>
                                        </div>
                                        <hr>
                                        <div class="form-group"><label class="col-sm-2 control-label">Ảnh Chứng Minh Thư:</label>
                                                <img class="col-sm-3" src="storage/cmnd/{{$res->cmnd}}">
                                        </div>
                                        <div class="form-group"><label class="col-sm-2">Ảnh Chân Dung:</label>
                                                    <img class="col-sm-3" src="storage/chandung/{{$res->chandung}}">
                                        </div>
                                    </fieldset>
                                    <button style="float: right" class="btn btn-lg btn-danger" type="submit" name="button" value="cancel">
                                        Hủy Bỏ
                                    </button>
                                    <button style="float: right; margin-right: 1%" class="btn btn-lg btn-info" type="submit" name="button" value="accept">
                                        Chấp Nhận
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection