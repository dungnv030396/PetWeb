@extends('layouts.master')
@section('content')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="/css/css-register.css" rel="stylesheet">
<script type="text/javascript">
    $(function () {
        var e = document.getElementById("citydrop");
        {{ strrev(str_after(strrev(\Illuminate\Support\Facades\Auth::user()->address),',')) }}
    });
</script>
    <div class="container" style="padding-top: 60px;">
        <h1 class="page-header">Thay Đổi Hồ Sơ Của Bạn</h1>
        <div class="row">
            <!-- left column -->

            {{--@foreach($user as $item)--}}
            <form method="POST" action="{{route('updateAvatar')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="text-center">
                        @if(str_contains(\Illuminate\Support\Facades\Auth::user()->avatar,'https://graph.facebook.com') OR str_contains(\Illuminate\Support\Facades\Auth::user()->avatar,'googleusercontent.com'))
                            <img src="{{\Illuminate\Support\Facades\Auth::user()->avatar }}"
                                 class="avatar img-circle img-thumbnail" alt="avatar">
                        @else
                            <img src="{{ 'storage/avatar/'.\Illuminate\Support\Facades\Auth::user()->avatar }}"
                                 class="avatar img-circle img-thumbnail" alt="avatar">
                        @endif
                        <h6>Thay đổi ảnh đại diện khác</h6>
                        <input type="file" class="text-center center-block well well-sm" name="avatar" id="avatar">
                        <input name="Submit" type="submit" value="Lưu Thay Đổi" class="btn btn-primary">
                        @if (session('statusUpdateAvatar'))
                            <div class="alert alert-success">
                                <ul>
                                    {{ session('statusUpdateAvatar') }}
                                </ul>
                            </div>
                        @endif
                        @if (session('errorFile'))
                            <div class="alert alert-danger">
                                <ul>
                                    {{ session('errorFile') }}
                                </ul>
                            </div>
                        @endif
                        @if (session('errorNull'))
                            <div class="alert alert-danger">
                                <ul>
                                    {{ session('errorNull') }}
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </form>

            <!-- edit form column -->
            <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <div class="alert alert-info alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a>
                    <i class="fa fa-coffee"></i>
                    Đây là nơi hiển thị <strong>.Thông Báo</strong>. Sử dụng để thông báo những tin nhắn quan trọng
                    tới người dùng.
                </div>
                <h3>Thông Tin Người Dùng</h3>
                <form class="form-horizontal" role="form" method="POST" action="{{route('updateInfo')}}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Họ và Tên:</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}"
                                   type="text" name="mem_name"
                                   required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}"
                                   type="text" name="emailid" readonly
                                   required>
                            </div>
                        </div>
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
                                <input type="text" class="form-control" name="phonenumber" id="phonenumber"
                                       value="{{ \Illuminate\Support\Facades\Auth::user()->phoneNumber }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Địa Chỉ:</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input style="height: 100px" class="form-control" value="{{ strrev(str_after(strrev(\Illuminate\Support\Facades\Auth::user()->address),',')) }}"
                                   type="text" name="address"
                                   required>
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
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-xs-offset-3 col-xs-10">
                            <input name="Submit" type="submit" value="Lưu Thay Đổi" class="btn btn-primary">
                            <span></span>
                            <input class="btn btn-default" value="Hủy" type="reset">
                        </div>

                    </div>
                </form>
                <div class="form-group">

                    @if (session('statusUpdateProfile'))
                        <div class="alert alert-success">
                            <ul>
                                {{ session('statusUpdateProfile') }}
                            </ul>
                        </div>
                    @endif

                    @if ($errors->has('phonenumber'))
                        @include('layouts.errors')
                    @endif
                </div>
                    <hr>
                    <small style="color: #f90">Chúng tôi sẽ gửi tiền cho bạn thông qua tài khoản ngân hàng này. Nếu bạn là một nhà cung cấp hãy cung cấp cho chúng tôi chính xác thông tin ngân hàng.</small>
                    <br>
                <form action="{{route('updateUserBankInfo')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Tên Ngân Hàng:</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-bold"></i></span>
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->bank_name }}"
                                   type="text" name="bank_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Tên Chủ Tài Khoản:</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->bank_username }}"
                                   type="text" name="bank_username" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Số Tài Khoản:</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->card_number }}"
                                   type="text" name="card_number" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Chi Nhánh:</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->bank_branch }}"
                                   type="text" name="bank_branch" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-xs-offset-3 col-xs-10">
                            <input name="Submit" type="submit" value="Lưu Thay Đổi" class="btn btn-primary">
                            <span></span>
                            <input class="btn btn-default" value="Hủy" type="reset">
                        </div>

                    </div>

                </form>
                <div class="form-group">

                    @if (session('updateUserBankInfo'))
                        <div class="alert alert-success">
                            <ul>
                                {{ session('updateUserBankInfo') }}
                            </ul>
                        </div>
                    @endif

                    @if ($errors->has('card_number'))
                        @include('layouts.errors')
                    @endif
                </div>

                <hr>

                <form class="form-horizontal" role="form" method="POST" action="{{route('updatePass')}}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mật Khẩu Hiện Tại:</label>
                        <div class="col-md-8">
                            <input class="form-control" name="oldpwd" type="password"
                                   placeholder="Nhập mật khẩu hiện tại của bạn" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mật Khẩu Mới:</label>
                        <div class="col-md-8">
                            <input class="form-control" name="password" type="password"
                                   placeholder="Nhật mật khẩu mới" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Xác Nhận Mật Khẩu Mới:</label>
                        <div class="col-md-8">
                            <input class="form-control" name="password_confirmation" id="password_confirmation"
                                   type="password"
                                   placeholder="Xác nhận mật khẩu mới" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input name="Submit" type="submit" value="Đổi Mật Khẩu" class="btn btn-primary">
                        </div>
                    </div>
                    @if (session('statusUpdatePass'))
                        <div class="alert alert-success">
                            <ul>
                                {{ session('statusUpdatePass') }}
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">

                        @include('layouts.errors')

                    </div>
                </form>
            </div>

            {{--@endforeach--}}
        </div>
    </div>
@endsection
