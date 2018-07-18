<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="/css/css-login.css" rel="stylesheet">

<!------ Include the above in your HEAD tag ---------->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--<p>Some text in the modal.</p>--}}
            {{--</div>--}}

            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-md-offset-4">
                        <div class="account-box">
                            <div class="logo ">
                                <img src="http://placehold.it/90x38/fff/6E329D&text=LOGO" alt=""/>
                            </div>
                            <form class="form-signin" method="POST" action="login">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Tên Tài Khoản" required autofocus />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Mật Khẩu" required />
                                </div>
                                @include('layouts.errors')
                                <button class="btn btn-lg btn-block purple-bg" type="submit">
                                    Đăng Nhập</button>
                            </form>
                            <a class="forgotLnk" href="#">Quên mật khẩu</a>
                            <div class="or-box">
                                <span class="or">Hoặc</span>
                                <div class="row">
                                    <div class="col-md-6 row-block">
                                        <a href="http://www.jquery2dotnet.com" class="btn btn-facebook btn-block">Facebook</a>
                                    </div>
                                    <div class="col-md-6 row-block">
                                        <a href="http://www.jquery2dotnet.com" class="btn btn-google btn-block">Google</a>
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
</div>