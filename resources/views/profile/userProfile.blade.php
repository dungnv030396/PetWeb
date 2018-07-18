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
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="text-center">
                <img src="http://lorempixel.com/200/200/people/9/" class="avatar img-circle img-thumbnail" alt="avatar">
                <h6>Thay đổi ảnh đại diện khác</h6>
                <input type="file" class="text-center center-block well well-sm">
            </div>
        </div>
        <!-- edit form column -->
        <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
            <div class="alert alert-info alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a>
                <i class="fa fa-coffee"></i>
                Đây là nơi hiển thị <strong>.Thông Báo</strong>. Sử dụng để thông báo những tin nhắn quan trọng tới người dùng.
            </div>
            <h3>Thông Tin Người Dùng</h3>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Họ và Tên:</label>
                    <div class="col-lg-8">
                        <input class="form-control" value="....." type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input class="form-control" value="......." type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Giới Tính <span class="text-danger">*</span></label>
                    <div class="col-md-8 col-sm-9">
                        <label>
                            <input name="gender" type="radio" value="nam" checked>
                            Nam </label>
                           
                        <label>
                            <input name="gender" type="radio" value="nu" >
                            Nữ </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Ngày Tháng Năm Sinh <span class="text-danger">*</span></label>
                    <div class="col-xs-8">
                        <div class="form-inline">
                            <div class="form-group">
                                <select name="dd" class="form-control">
                                    <option value="">Ngày</option>
                                    <option value="1" >01 </option><option value="2" >02 </option><option value="3" >03 </option><option value="4" >04 </option><option value="5" >05 </option><option value="6" >06 </option><option value="7" >07 </option><option value="8" >08 </option><option value="9" >09 </option><option value="10" >10 </option><option value="11" >11 </option><option value="12" >12 </option><option value="13" >13 </option><option value="14" >14 </option><option value="15" >15 </option><option value="16" >16 </option><option value="17" >17 </option><option value="18" >18 </option><option value="19" >19 </option><option value="20" >20 </option><option value="21" >21 </option><option value="22" >22 </option><option value="23" >23 </option><option value="24" >24 </option><option value="25" >25 </option><option value="26" >26 </option><option value="27" >27 </option><option value="28" >28 </option><option value="29" >29 </option><option value="30" >30 </option><option value="31" >31 </option>                </select>
                            </div>
                            <div class="form-group">
                                <select name="mm" class="form-control">
                                    <option value="">Tháng</option>
                                    <option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>                </select>
                            </div>
                            <div class="form-group" >
                                <select name="yyyy" class="form-control">
                                    <option value="0">Năm</option>
                                    <option value="1955" >1955 </option><option value="1956" >1956 </option><option value="1957" >1957 </option><option value="1958" >1958 </option><option value="1959" >1959 </option><option value="1960" >1960 </option><option value="1961" >1961 </option><option value="1962" >1962 </option><option value="1963" >1963 </option><option value="1964" >1964 </option><option value="1965" >1965 </option><option value="1966" >1966 </option><option value="1967" >1967 </option><option value="1968" >1968 </option><option value="1969" >1969 </option><option value="1970" >1970 </option><option value="1971" >1971 </option><option value="1972" >1972 </option><option value="1973" >1973 </option><option value="1974" >1974 </option><option value="1975" >1975 </option><option value="1976" >1976 </option><option value="1977" >1977 </option><option value="1978" >1978 </option><option value="1979" >1979 </option><option value="1980" >1980 </option><option value="1981" >1981 </option><option value="1982" >1982 </option><option value="1983" >1983 </option><option value="1984" >1984 </option><option value="1985" >1985 </option><option value="1986" >1986 </option><option value="1987" >1987 </option><option value="1988" >1988 </option><option value="1989" >1989 </option><option value="1990" >1990 </option><option value="1991" >1991 </option><option value="1992" >1992 </option><option value="1993" >1993 </option><option value="1994" >1994 </option><option value="1995" >1995 </option><option value="1996" >1996 </option><option value="1997" >1997 </option><option value="1998" >1998 </option><option value="1999" >1999 </option><option value="2000" >2000 </option><option value="2001" >2001 </option><option value="2002" >2002 </option><option value="2003" >2003 </option><option value="2004" >2004 </option><option value="2005" >2005 </option><option value="2006" >2006 </option>                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">SDT. <span class="text-danger">*</span></label>
                    <div class="col-md-5 col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                            <input type="text" class="form-control" name="contactnum" id="contactnum" placeholder="Nhập số điện thoại của bạn ở đây" value="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Mật Khẩu:</label>
                    <div class="col-md-8">
                        <input class="form-control" value="11111122333" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Xác Nhận Mật Khẩu:</label>
                    <div class="col-md-8">
                        <input class="form-control" value="11111122333" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input class="btn btn-primary" value="Lưu Thay Đổi" type="button">
                        <span></span>
                        <input class="btn btn-default" value="Hủy" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    @endsection