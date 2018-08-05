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
                    <hr>
                    <form class="form-horizontal" method="POST" name="signup" id="signup" enctype="multipart/form-data" action="registerToSupplier" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-sm-3">Họ và Tên <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-sm-9">
                                <input type="text" class="form-control" name="mem_name" id="mem_name" placeholder="Nhập Họ và Tên của bạn ở đây" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}" required>
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
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-collapse-down"></i></span>
                                    <input style="height: 70px" type="text" class="form-control" name="address" id="address" placeholder="Nhập địa chỉ của bạn ở đây" value="{{ \Illuminate\Support\Facades\Auth::user()->address }}" required>
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

                        <small style="color: #f90">Ảnh chứng minh thư cần scan 2 mặt</small>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Ảnh Chứng Mình Thư:</label>
                            <div class="col-lg-8">
                                <input style="float: left" type="file" class="text-center center-block well well-sm" name="cmnd"  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Ảnh Chân Dung:</label>
                            <div class="col-lg-8">
                                <input style="float: left" type="file" class="text-center center-block well well-sm" name="avatar"required>
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

                        @include('layouts.errors')

                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection