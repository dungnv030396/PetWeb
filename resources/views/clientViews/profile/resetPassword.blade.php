@extends('layouts.master')
@section('content')
    <link href="css/css-resetPass.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Khôi Phục Mật Khẩu?</h2>
                            <p>Bạn có thể khôi phục mật khẩu ở đây.</p>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="{{route('resetPassword')}}">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="địa chỉ email" class="form-control"  type="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Khôi Phục Mật Khẩu" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>
                                @if (session('resetPassSuccess'))
                                    <div class="alert alert-success">
                                        <ul>
                                            {{ session('resetPassSuccess') }}
                                        </ul>
                                    </div>
                                @endif
                                @if (session('emailNotFound'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            {{ session('emailNotFound') }}
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection