<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Pet Family | Moderator | Login</title>
    <base href="{{asset('')}}">
    <link href="source/assets/manage/css/bootstrap.min.css" rel="stylesheet">
    <link href="source/assets/manage/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="source/assets/manage/css/animate.css" rel="stylesheet">
    <link href="source/assets/manage/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
{{--@if(\Illuminate\Support\Facades\Auth::check())--}}
    {{--<h1>{{ \Illuminate\Support\Facades\Auth::user()->name }}</h1>--}}
{{--@endif--}}
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">TPF</h1>

        </div>
        <h3>Chào mừng đã tới TPF</h3>
        <p>Đăng nhập để tới trang quản lí của quản trị viên.</p>
        <form class="m-t" role="form" action="{{route('loginModerator')}}" method="POST">

            {{ csrf_field() }}
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Địa Chỉ Email" required=""
                       value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mật Khẩu" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Đăng Nhập</button>
            <br><br>
        </form>

        <div class="form-group">
            @include('layouts.errors')
        </div>
        <div class="form-group">
            @if (session('message'))
                <div class="alert alert-danger">
                    <ul style="text-align: center">
                        {{ session('message') }}
                    </ul>
                </div>
            @endif
        </div>
        <p class="m-t">
            {{--<small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>--}}
        </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="source/assets/manage/js/jquery-2.1.1.js"></script>
<script src="source/assets/manage/js/bootstrap.min.js"></script>

</body>

</html>
