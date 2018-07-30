@extends('layouts.master')
@section('content')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="/css/css-register.css" rel="stylesheet">
    <!------ Include the above in your HEAD tag ---------->

    <div class="container" style="padding-top: 60px;">
        <h1 class="page-header">Thay Đổi Hồ Sơ Của Bạn</h1>
        <div class="row">
            <!-- left column -->

            {{--@foreach($user as $item)--}}
            <form method="POST" action="updateAvatar" enctype="multipart/form-data">
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
                <form class="form-horizontal" role="form" method="POST" action="updateInfo">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Họ và Tên:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}"
                                   type="text" name="mem_name"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}"
                                   type="text" name="emailid" readonly
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Giới Tính <span class="text-danger">*</span></label>
                        <div class="col-md-8 col-sm-9">
                            @if(\Illuminate\Support\Facades\Auth::user()->gender == '1')
                                <label>
                                    <input name="gender" type="radio" value="nam" checked>
                                    Nam </label>
                                   
                                <label>
                                    <input name="gender" type="radio" value="nu">
                                    Nữ </label>
                            @else
                                <label>
                                    <input name="gender" type="radio" value="nam">
                                    Nam </label>
                                   
                                <label>
                                    <input name="gender" type="radio" value="nu" checked>
                                    Nữ </label>
                            @endif
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                    {{--<label class="control-label col-sm-3">Ngày Tháng Năm Sinh <span class="text-danger">*</span></label>--}}
                    {{--<div class="col-xs-8">--}}
                    {{--<div class="form-inline">--}}
                    {{--<div class="form-group">--}}
                    {{--<select name="dd" class="form-control">--}}
                    {{--<option value="">Ngày</option>--}}
                    {{--<option value="1" >01 </option><option value="2" >02 </option><option value="3" >03 </option><option value="4" >04 </option><option value="5" >05 </option><option value="6" >06 </option><option value="7" >07 </option><option value="8" >08 </option><option value="9" >09 </option><option value="10" >10 </option><option value="11" >11 </option><option value="12" >12 </option><option value="13" >13 </option><option value="14" >14 </option><option value="15" >15 </option><option value="16" >16 </option><option value="17" >17 </option><option value="18" >18 </option><option value="19" >19 </option><option value="20" >20 </option><option value="21" >21 </option><option value="22" >22 </option><option value="23" >23 </option><option value="24" >24 </option><option value="25" >25 </option><option value="26" >26 </option><option value="27" >27 </option><option value="28" >28 </option><option value="29" >29 </option><option value="30" >30 </option><option value="31" >31 </option>                </select>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--<select name="mm" class="form-control">--}}
                    {{--<option value="">Tháng</option>--}}
                    {{--<option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>                </select>--}}
                    {{--</div>--}}
                    {{--<div class="form-group" >--}}
                    {{--<select name="yyyy" class="form-control">--}}
                    {{--<option value="0">Năm</option>--}}
                    {{--<option value="1955" >1955 </option><option value="1956" >1956 </option><option value="1957" >1957 </option><option value="1958" >1958 </option><option value="1959" >1959 </option><option value="1960" >1960 </option><option value="1961" >1961 </option><option value="1962" >1962 </option><option value="1963" >1963 </option><option value="1964" >1964 </option><option value="1965" >1965 </option><option value="1966" >1966 </option><option value="1967" >1967 </option><option value="1968" >1968 </option><option value="1969" >1969 </option><option value="1970" >1970 </option><option value="1971" >1971 </option><option value="1972" >1972 </option><option value="1973" >1973 </option><option value="1974" >1974 </option><option value="1975" >1975 </option><option value="1976" >1976 </option><option value="1977" >1977 </option><option value="1978" >1978 </option><option value="1979" >1979 </option><option value="1980" >1980 </option><option value="1981" >1981 </option><option value="1982" >1982 </option><option value="1983" >1983 </option><option value="1984" >1984 </option><option value="1985" >1985 </option><option value="1986" >1986 </option><option value="1987" >1987 </option><option value="1988" >1988 </option><option value="1989" >1989 </option><option value="1990" >1990 </option><option value="1991" >1991 </option><option value="1992" >1992 </option><option value="1993" >1993 </option><option value="1994" >1994 </option><option value="1995" >1995 </option><option value="1996" >1996 </option><option value="1997" >1997 </option><option value="1998" >1998 </option><option value="1999" >1999 </option><option value="2000" >2000 </option><option value="2001" >2001 </option><option value="2002" >2002 </option><option value="2003" >2003 </option><option value="2004" >2004 </option><option value="2005" >2005 </option><option value="2006" >2006 </option>                </select>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label class="control-label col-sm-3">SDT. <span class="text-danger">*</span></label>
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
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->address }}"
                                   type="text" name="address"
                                   required>
                        </div>
                    </div>
                    <hr>
                    <small style="color: #f90">Chúng tôi sẽ gửi tiền cho bạn thông qua tài khoản ngân hàng này. Nếu bạn là một nhà cung cấp hãy cung cấp cho chúng tôi chính xác thông tin ngân hàng.</small>
                    <br>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Tên Ngân Hàng:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->bank_name }}"
                                   type="text" name="bank_name"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Tên Chủ Tài Khoản:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->bank_username }}"
                                   type="text" name="bank_username"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Số Tài Khoản:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->card_number }}"
                                   type="text" name="card_number"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Chi Nhánh:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ \Illuminate\Support\Facades\Auth::user()->bank_branch }}"
                                   type="text" name="bank_branch"
                                   required>
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

                <form class="form-horizontal" role="form" method="POST" action="updatePass">

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