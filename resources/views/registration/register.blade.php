@extends('layouts.master')
@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/css-register.css" rel="stylesheet">

<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <section>
                <br>
                <h1 class="entry-title main-color"><span>Đăng Ký</span> </h1>
                <div class="form-group">
                    @if (session('status'))
                        <div class="alert alert-success">
                            <ul>
                                {{ session('status') }}
                            </ul>
                        </div>
                    @endif
                </div>
                <hr>
                <form class="form-horizontal" method="POST" name="signup" id="signup" enctype="multipart/form-data" action="{{route('register')}}" >
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label col-sm-3">Họ và Tên <span class="text-danger">*</span></label>
                        <div class="col-md-8 col-sm-9">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" name="mem_name" id="mem_name" placeholder="Nhập Họ và Tên của bạn ở đây" value="{{ old('mem_name') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Email<span class="text-danger">*</span></label>
                        <div class="col-md-8 col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" class="form-control" name="emailid" id="emailid" placeholder="Nhập vào email của bạn" value="{{ old('emailid') }}" required>
                            </div>
                            <small> Email của bạn được sử dụng để <a style="color: #f90"> đăng nhập vào hệ thống </a>đảm bảo tính bảo mật cho tài khoản của bạn, ủy quyền và khôi phục quyền truy cập.. </small> </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Mật Khẩu <span class="text-danger">*</span></label>
                        <div class="col-md-5 col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Nhập Mật Khẩu (6-15 chars)" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Xác Nhận Mật Khẩu <span class="text-danger">*</span></label>
                        <div class="col-md-5 col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập Mật Khẩu Xác Nhận" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Giới Tính <span class="text-danger">*</span></label>
                        <div class="col-md-8 col-sm-9">
                            <label>
                                <input name="gender" type="radio" value="1" checked>
                                Nam </label>
                               
                            <label>
                                <input name="gender" type="radio" value="0" >
                                Nữ </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Số Điện Thoại <span class="text-danger">*</span></label>
                        <div class="col-md-5 col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                <input type="text" class="form-control" name="phonenumber" id="phonenumber" placeholder="Nhập số điện thoại của bạn ở đây" value="{{ old('phonenumber') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Địa Chỉ <span class="text-danger">*</span></label>
                        <div class="col-md-5 col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input style="height: 70px" type="text" class="form-control" name="address" id="address" placeholder="Nhập địa chỉ của bạn ở đây" value="{{ old('address') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Tỉnh/Thành Phố <span class="text-danger">*</span></label>
                        <div class="col-md-5 col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                                <select name="city" class="form-control" id="citydrop">
                                    @foreach($cities as $city)
                                        <option value="{{$city->code}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label class="control-label col-sm-3">Ảnh Đại Diện <br>--}}
                            {{--<small>(optional)</small></label>--}}
                        {{--<div class="col-md-5 col-sm-8">--}}
                            {{--<div class="input-group"> <span class="input-group-addon" id="file_upload"><i class="glyphicon glyphicon-upload"></i></span>--}}
                                {{--<input type="file" name="file_nm" id="file_nm" class="form-control upload" placeholder="" aria-describedby="file_upload">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <div class="col-xs-offset-3 col-md-8 col-sm-9"><span class="text-muted"><span class="label label-danger">Lưu ý:-</span> Bằng cách nhấp vào Đăng ký, bạn đồng ý với <a href="#">Điều khoản</a> của chúng tôi và bạn đã đọc <a href="#">Chính sách</a> của chúng tôi, bao gồm cả việc sử dụng <a href="#">Cookie</a> của chúng tôi..</span> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-10">
                            <input name="Submit" type="submit" value="Đăng Ký" class="btn btn-primary">
                        </div>
                    </div>
                </form>

                <div class="form-group">

                    @include('layouts.errors')

                </div>
            </section>
        </div>
    </div>
</div>
    @endsection