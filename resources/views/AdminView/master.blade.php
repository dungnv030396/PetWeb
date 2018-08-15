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
                            <img alt="image" class="img-circle" src="source/assets/manage/img/profile_small.jpg"/>
                             </span>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b
                                            class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('logoutAdmin') }}">Logout</a></li>
                            </ul>
                        @endif
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li class="{{($menu=='home')?'active':''}}"><a href="{{route('admin_manage_place')}}"><i
                                class="fa fa-home"></i> <span class="nav-label">Trang chủ</span></a></li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control"
                                   name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Chào Mừng Đến Trang Quản Lí Của Quản Trị Viên.</span>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="grid_options.html">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="notifications.html">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('logoutAdmin') }}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                    <li>
                        <a class="right-sidebar-toggle">
                            <i class="fa fa-tasks"></i>
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
<script src="source/assets/manage/js/plugins/flot/jquery.flot.js"></script>
<script src="source/assets/manage/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="source/assets/manage/js/plugins/flot/jquery.flot.spline.js"></script>
}
<script src="source/assets/manage/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="source/assets/manage/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="source/assets/manage/js/plugins/peity/jquery.peity.min.js"></script>
<script src="source/assets/manage/js/demo/peity-demo.js"></script>
<script src="source/assets/manage/js/plugins/pace/pace.min.js"></script>
<script src="source/assets/manage/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="source/assets/manage/js/plugins/gritter/jquery.gritter.min.js"></script>
<script src="source/assets/manage/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="source/assets/manage/js/demo/sparkline-demo.js"></script>
<script src="source/assets/manage/js/plugins/chartJs/Chart.min.js"></script>
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


        var data1 = [
            [0, 4], [1, 8], [2, 5], [3, 10], [4, 4], [5, 16], [6, 5], [7, 11], [8, 6], [9, 11], [10, 30], [11, 10], [12, 13], [13, 4], [14, 3], [15, 3], [16, 6]
        ];
        var data2 = [
            [0, 1], [1, 0], [2, 2], [3, 0], [4, 1], [5, 3], [6, 1], [7, 5], [8, 2], [9, 3], [10, 2], [11, 1], [12, 0], [13, 2], [14, 8], [15, 0], [16, 0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
            {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1ab394", "#1C84C6"],
                xaxis: {},
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            }
        );

    });
</script>
</body>
</html>
