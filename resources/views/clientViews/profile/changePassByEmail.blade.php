@extends('layouts.master')
@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="/css/css-register.css" rel="stylesheet">

<div class="container" style="padding-top: 60px;">
    <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
            <h3 class="main-color">Thay Đổi Mật Khẩu</h3>
            <br>

            <form class="form-horizontal" role="form" method="POST" action="changePassByMail">
                {{ csrf_field() }}
                <input type="text" name="id" hidden value="{{ strrev(str_before(strrev(Request::url()),'/')) }}">
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
            </form>
            @if (session('ChangePassSuccess'))
                <div class="alert alert-success">
                    <ul>
                        {{ session('ChangePassSuccess') }}
                    </ul>
                </div>
            @endif

            <div class="form-group">

                @include('layouts.errors')

            </div>
        </div>
    </div>
</div>
    @endsection