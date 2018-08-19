<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/css-login.css" rel="stylesheet">
{{--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>--}}
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
    <script>
        $(function () {
            $('#myModal').modal('show');
        });
    </script>
@endif
<!------ Include the above in your HEAD tag ---------->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        {{--modal-dialog-centered--}}
        <div class="container">
            <div class="col-md-3 col-md-offset-4">
                <div class="account-box">
                    <div class="logo ">
                        <img src="http://placehold.it/90x38/fff/6E329D&text=LOGO" alt=""/>
                    </div>
                    <form class="form-signin" method="POST" action="login">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="emailid"
                                   placeholder="Địa Chỉ Email" required autofocus/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password"class="form-control"
                                   placeholder="Mật Khẩu" required/>
                        </div>
                        @if (session('emailNull'))
                            <div class="alert alert-danger">
                                <ul>
                                    {{ session('emailNull') }}
                                </ul>
                            </div>
                        @endif
                        @include('layouts.errors')

                        <button class="btn btn-lg btn-block purple-bg" type="submit">
                            Đăng Nhập
                        </button>
                    </form>
                    <a class="forgotLnk" href="{{Route('resetPasswordPage')}}">Quên mật khẩu</a>
                    <div class="or-box">
                        <span class="or">Hoặc</span>
                        <div class="row">
                            <div class="col-md-6 row-block">
                                <a href="login/facebook" class="btn btn-facebook btn-block">Facebook</a>
                            </div>
                            <div class="col-md-6 row-block">
                                <a href="login/google" class="btn btn-google btn-block">Google</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-close" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>