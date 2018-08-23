<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>The Pet Family</title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link href="source/assets/manage/css/bootstrap.min.css" rel="stylesheet">
    <link href="source/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="source/assets/manage/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="source/assets/manage/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="source/assets/manage/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="source/assets/manage/css/plugins/select2/select2.min.css" rel="stylesheet">
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
                            <img alt="image" class="img-circle" src="{{'storage/avatar/'.\Illuminate\Support\Facades\Auth::user()->avatar }}" width="80px"
                                 height="80px"/>
                             </span>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">ADMIN</span> </span>
                        @endif
                    </div>
                    <div class="logo-element">
                        TPF+
                    </div>
                </li>
                <li class="{{($menu=='home')?'active':''}}"><a href="{{route('admin_manage_place')}}"><i
                                class="fa fa-home"></i> <span class="nav-label">Trang chủ</span></a>
                </li>
                <li class="{{($menu=='listusers')?'active':''}}">
                    <a href=""><i class="fa fa-group"></i> <span class="nav-label">Quản Lý Tài Khoản</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('getListCustomerPage')}}">Khách Hàng</a></li>
                        <li><a href="{{route('getListCustomersBlockedPage')}}">Khách Hàng Bị Khóa</a></li>
                        <li><a href="{{route('getListSupplierPage')}}">Nhà Cung Cấp</a></li>
                        <li><a href="{{route('getListSupplierBlockedPage')}}">Nhà Cung Cấp Bị Khóa</a></li>
                        <li><a href="{{route('getListModeratorsPage')}}">Quản Trị Viên</a></li>
                        <li><a href="{{route('getListModeratorBlockedPage')}}">Quản Trị Viên Bị Khóa</a></li>
                    </ul>
                </li>
                <li class="{{($menu=='finance')?'active':''}}">
                    <a href="#"><i class="fa fa-money"></i> <span class="nav-label">Quản lý tài chính</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('supplierFinanceView')}}">Thanh toán cho nhà cung cấp</a></li>
                        <li><a href="{{route('webFinanceView')}}">Thống kê tài chính</a></li>
                    </ul>
                </li>
                <li class="{{($menu=='report')?'active':''}}">
                    <a href="{{route('getListsReport')}}"><i class="fa fa-flag"></i> <span class="nav-label">Quản lý Báo Cáo</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('getListsReport')}}">Báo cáo chờ xử lý</a></li>
                        <li><a href="{{route('getListsProcessedReport')}}">Báo cáo đã xử lý</a></li>
                    </ul>
                </li>
                <li class="{{($menu=='supplier')?'active':''}}">
                    <a href="{{route('listRegistrationForm')}}"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">Xét Duyệt Đơn</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="{{redirect()->back()}}"><i class="fa fa-bars"></i>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Chào Mừng Đến Trang Quản Lí Của Admin.</span>
                    </li>
                    <li>
                        <a href="{{ route('logoutAdmin') }}">
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
<script src="source/assets/manage/js/plugins/flot/jquery.flot.js"></script>
<script src="source/assets/manage/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="source/assets/manage/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="source/assets/manage/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="source/assets/manage/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="source/assets/manage/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="source/assets/manage/js/plugins/flot/jquery.flot.time.js"></script>
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
            toastr.success('The Pet Family Company', 'Quản lý của admin!');

        }, 1300);

        // var data2 = [
        //     [gd(2012, 1, 1), 20], [gd(2012, 1, 2), 20], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
        //     [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
        //     [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
        //     [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
        //     [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
        //     [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
        //     [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
        //     [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
        // ];
        //
        // var data3 = [
        //     [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
        //     [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
        //     [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
        //     [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
        //     [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
        //     [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
        //     [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
        //     [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
        // ];
        //
        //
        // var dataset = [
        //     {
        //         label: "Số lượng đơn hàng",
        //         data: data3,
        //         color: "#1ab394",
        //         bars: {
        //             show: true,
        //             align: "center",
        //             barWidth: 24 * 60 * 60 * 600,
        //             lineWidth:0
        //         }
        //
        //     }, {
        //         label: "Doanh thu",
        //         data: data2,
        //         yaxis: 2,
        //         color: "#1C84C6",
        //         lines: {
        //             lineWidth:1,
        //             show: true,
        //             fill: true,
        //             fillColor: {
        //                 colors: [{
        //                     opacity: 0.2
        //                 }, {
        //                     opacity: 0.4
        //                 }]
        //             }
        //         },
        //         splines: {
        //             show: false,
        //             tension: 0.6,
        //             lineWidth: 1,
        //             fill: 0.1
        //         },
        //     }
        // ];
        //
        //
        // var options = {
        //     xaxis: {
        //         mode: "time",
        //         tickSize: [3, "day"],
        //         tickLength: 0,
        //         axisLabel: "Date",
        //         axisLabelUseCanvas: true,
        //         axisLabelFontSizePixels: 12,
        //         axisLabelFontFamily: 'Arial',
        //         axisLabelPadding: 10,
        //         color: "#d5d5d5"
        //     },
        //     yaxes: [{
        //         position: "left",
        //         max: 1070,
        //         color: "#d5d5d5",
        //         axisLabelUseCanvas: true,
        //         axisLabelFontSizePixels: 12,
        //         axisLabelFontFamily: 'Arial',
        //         axisLabelPadding: 3
        //     }, {
        //         position: "right",
        //         clolor: "#d5d5d5",
        //         axisLabelUseCanvas: true,
        //         axisLabelFontSizePixels: 12,
        //         axisLabelFontFamily: ' Arial',
        //         axisLabelPadding: 67
        //     }
        //     ],
        //     legend: {
        //         noColumns: 1,
        //         labelBoxBorderColor: "#000000",
        //         position: "nw"
        //     },
        //     grid: {
        //         hoverable: false,
        //         borderWidth: 0
        //     }
        // };
        //
        // function gd(year, month, day) {
        //     return new Date(year, month - 1, day).getTime();
        // }
        //
        // var previousPoint = null, previousLabel = null;
        //
        // $.plot($("#flot-dashboard-chart"), dataset, options);




    });
</script>
</body>
</html>
