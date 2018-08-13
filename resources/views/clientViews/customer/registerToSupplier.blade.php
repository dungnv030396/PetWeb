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
                    <h1 class="entry-title main-color"><span>Đăng Ký Trở Thành Nhà Cung Cấp</span> </h1>
                    @if($count>0)
                    <h5 class="entry-title" style="color: #00A8FF"><a href="{{route('registerSupplierSuccess',\Illuminate\Support\Facades\Auth::user()->id)}}">Bạn gửi 1 phiếu đăng ký(ấn để xem chi tiết)</a></h5>
                    @endif
                    <hr>
                    <form class="form-horizontal" method="POST" name="signup" id="signup" enctype="multipart/form-data" action="{{route('registerToSupplier')}}" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-sm-3">Họ và Tên <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="mem_name" id="mem_name" placeholder="Nhập Họ và Tên của bạn ở đây" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Email<span class="text-danger">*</span></label>
                            <div class="col-md-8 col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="email" class="form-control" name="emailid" id="emailid" placeholder="Nhập vào email của bạn" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" readonly required>
                                </div>
                                <small> Email của bạn được sử dụng để <a style="color: #f90"> đăng nhập vào hệ thống </a>đảm bảo tính bảo mật cho tài khoản của bạn, ủy quyền và khôi phục quyền truy cập.. </small> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Giới Tính <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-sm-9">
                                @if(\Illuminate\Support\Facades\Auth::user()->gender == '1')
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
                                    <input type="text" class="form-control" name="phonenumber" id="phonenumber" placeholder="Nhập số điện thoại của bạn ở đây" value="{{ \Illuminate\Support\Facades\Auth::user()->phoneNumber }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Địa Chỉ <span class="text-danger">*</span></label>
                            <div class="col-md-5 col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                    <input style="height: 70px" type="text" class="form-control" name="address" id="address" placeholder="Nhập địa chỉ của bạn ở đây" value="{{ strrev(str_after(strrev(\Illuminate\Support\Facades\Auth::user()->address),',')) }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Thành Phố <span class="text-danger">*</span></label>
                            <div class="col-md-5 col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                                    <select name="city" class="form-control" id="citydrop">
                                        @foreach($cities as $city)
                                            {{$check = ''}}
                                            @if(!empty($userCity))
                                                @if($userCity->code == $city->code)
                                                    {{$check = 'selected'}}
                                                @endif
                                            @endif
                                            <option value="{{$city->code}}" {{$check}}>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <small style="color: #f90">Sử dụng mật khẩu này để đăng nhập vào trang quản lí của nhà cung cấp,<b>Khi trở thành nhà cung cấp đây sẽ là mật khẩu của bạn.Nếu sử dụng tài khoản của TPF tốt nhất bạn nên điền mật khẩu cũ (Nếu đã đăng kí trước đó xin vui lòng điền mật khẩu đã đăng kí)</b> .</small>
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
                        <small style="color: #f90">Chúng tôi sẽ gửi tiền cho bạn thông qua tài khoản ngân hàng này. Nếu bạn là một nhà cung cấp hãy cung cấp cho chúng tôi chính xác thông tin ngân hàng.</small>
                        <br>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Tên Ngân Hàng: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-bold"></i></span>
                                <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->bank_name }}"
                                       type="text" name="bank_name"
                                       required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Tên Chủ Tài Khoản: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->bank_username }}"
                                       type="text" name="bank_username"
                                       required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Số Tài Khoản: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->card_number }}"
                                       type="text" name="card_number"
                                       required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Chi Nhánh: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->bank_branch }}"
                                       type="text" name="bank_branch"
                                       required>
                                </div>
                            </div>
                        </div>

                        <small style="color: #f90">Ảnh chứng minh thư cần scan 2 mặt</small>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Ảnh Chứng Mình Thư: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input style="float: left" type="file" class="text-center center-block well well-sm" name="cmnd" id="cmnd"  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Ảnh Chân Dung: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input style="float: left" type="file" class="text-center center-block well well-sm" name="avatar" id="avatar" required>
                            </div>
                        </div>
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
                        @if (session('registerToSupSuccess'))
                            <div class="alert alert-success">
                                <ul>
                                    {{ session('registerToSupSuccess') }}
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        @if (session('errorFile'))
                            <div class="alert alert-danger">
                                <ul>
                                    {{ session('errorFile') }}
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        @if (session('errorNull'))
                            <div class="alert alert-danger">
                                <ul>
                                    {{ session('errorNull') }}
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">

                        @include('layouts.errors')

                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection