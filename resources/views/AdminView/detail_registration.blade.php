@extends('AdminView.master')
@section('contentManager')
    {{--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">--}}
    {{--<link href="css/css-register.css" rel="stylesheet">--}}

    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <section>
                    <br>
                    <h1 class="entry-title" style="color: #0000F0"><span>Thông Tin Chi Tiết Phiếu Đăng Ký Số: {{ $res->id }}</span> </h1>
                    <hr>
                    <form class="form-horizontal" >
                        <div class="form-group">
                            <label class="control-label col-sm-3">Họ và Tên <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" value="{{ $res->name }}" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Email<span class="text-danger">*</span></label>
                            <div class="col-md-8 col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="email" class="form-control" value="{{ $res->email }}" readonly required>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Giới Tính <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-sm-9">
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
                        <div class="form-group">
                            <label class="control-label col-sm-3">Số Điện Thoại <span class="text-danger">*</span></label>
                            <div class="col-md-5 col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input type="text" class="form-control" value="{{ $res->phoneNumber }}" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Địa Chỉ <span class="text-danger">*</span></label>
                            <div class="col-md-5 col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                    <input style="height: 70px" type="text" class="form-control"value="{{ $res->address }}" required readonly>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Tên Ngân Hàng: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-bold"></i></span>
                                    <input class="form-control" value="{{ $res->bank_name }}"
                                           type="text" name="bank_name"
                                           required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Tên Chủ Tài Khoản: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input class="form-control" value="{{ $res->bank_username }}"
                                           type="text" name="bank_username"
                                           required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Số Tài Khoản: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <input class="form-control" value="{{ $res->card_number }}"
                                           type="text" name="card_number"
                                           required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Chi Nhánh: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    <input class="form-control" value="{{ $res->bank_name }}"
                                           type="text" name="bank_branch"
                                           required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Ảnh Chứng Mình Thư: <span class="text-danger">*</span></label>

                            <div class="col-lg-8">
                                <div style="width: 50%;height: 50%">
                                    <img src="storage/cmnd/{{ $res->cmnd }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Ảnh Chân Dung: <span class="text-danger">*</span></label>

                            <div class="col-lg-8">
                                <div style="width: 50%;height: 50%">
                                    <img src="storage/chandung/{{ $res->chandung }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection