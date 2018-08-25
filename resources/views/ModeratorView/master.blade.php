<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>The Pet Family</title>
    <base href="{{asset('')}}">
    <link href="source/assets/manage/css/bootstrap.min.css" rel="stylesheet">
    <link href="source/assets/manage/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="source/assets/manage/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="source/assets/manage/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="source/assets/manage/css/animate.css" rel="stylesheet">
    <link href="source/assets/manage/css/style.css" rel="stylesheet">

</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            @if(str_contains(\Illuminate\Support\Facades\Auth::user()->avatar,'https://graph.facebook.com') OR str_contains(\Illuminate\Support\Facades\Auth::user()->avatar,'googleusercontent.com'))
                                <img alt="image" class="img-circle"
                                     src="{{\Illuminate\Support\Facades\Auth::user()->avatar }}"
                                     width="80px"
                                     height="80px"/>
                            @else
                                <img alt="image" class="img-circle"
                                     src="{{'storage/avatar/'.\Illuminate\Support\Facades\Auth::user()->avatar }}"
                                     width="80px"
                                     height="80px"/>
                            @endif
                             </span>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Quản Trị Viên
                                            </span> </span>
                        @endif
                    </div>
                    <div class="logo-element">
                        TPF+
                    </div>
                </li>
                <li class="{{($menu=='home')?'active':''}}"><a href="{{route('moderator_manage_place')}}"><i
                                class="fa fa-home"></i> <span class="nav-label">Trang chủ</span></a></li>
                <li class="{{($menu=='order')?'active':''}}">
                    <a href="{{route('listOrder')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý order</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('listOrder')}}">Danh sách order</a></li>
                        @if($warehouses)
                            @foreach($warehouses as $warehouse)
                                <li><a href="{{route('orderOfWarehouse',$warehouse->id)}}">{{$warehouse->name}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="{{($menu=='product')?'active':''}}">
                    <a href="#"><i class="fa fa-cart-plus"></i> <span class="nav-label">Sản phẩm cần nhận</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if($warehouses)
                            @foreach($warehouses as $warehouse)
                                <li>
                                    <a href="{{route('productToWarehouseView',$warehouse->id)}}">{{$warehouse->name}}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="{{redirect()->back()}}"><i
                                class="fa fa-bars"></i>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Chào Mừng Đến Trang Quản Lí Của Quản Trị Viên.</span>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        @yield('contentManager')
    </div>
</div>

<script src="source/assets/manage/js/jquery-2.1.1.js"></script>
<script src="source/assets/manage/js/bootstrap.min.js"></script>
<script src="source/assets/manage/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="source/assets/manage/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="source/assets/manage/js/inspinia.js"></script>
<script src="source/assets/manage/js/plugins/toastr/toastr.min.js"></script>
<script src="source/assets/manage/js/plugins/pace/pace.min.js"></script>
<script src="source/assets/manage/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="source/assets/manage/js/plugins/gritter/jquery.gritter.min.js"></script>
<script src="source/assets/manage/js/plugins/dataTables/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

        }, 1300);

    });
</script>
</body>
</html>
