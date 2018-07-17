<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link rel="stylesheet" href="css/productManagement/base.css">
    <link rel="stylesheet" href="css/productManagement/cake.css">
    <link rel="stylesheet" href="css/productManagement/font-awesome.css">
    <link rel="stylesheet" href="css/productManagement/bootstrap.min.css">
    <link rel="stylesheet" href="css/productManagement/datatables.min.css">
    <link rel="stylesheet" href="css/productManagement/select2.min.css">
    <link rel="stylesheet" href="css/productManagement/sweetalert.css">
    <link rel="stylesheet" href="css/productManagement/animate.css">
    <link rel="stylesheet" href="css/productManagement/style.css">
    <link rel="stylesheet" href="css/productManagement/ghangtool.css">
    <link rel="stylesheet" href="css/productManagement/jquery.datetimepicker.css">
    <script src="js/productManagement/jquery-2.1.1.js"></script>
</head>

<body>

<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img src="source/image/product/pet_demo.jpg" class="img-circle">
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong
                                        class="font-bold">Nguyen Hiep</strong>
                        </span> <span class="text-muted text-xs block">Menu<b class="caret"></b>
                            </span></span></a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href=" ">Detail</a>
                            </li>
                            <li><a href=" ">Change password</a>
                            </li>
                            <li><a href=" ">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        G+
                    </div>
                </li>
                <br/><br/>
                <!-- thanh memu -->
                <li>
                    <a href="#"><i class="fa fa-user-circle"></i> <span class="nav-label">Quản lý tài khoản</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="">Thông tin</a></li>
                        <li><a href="">Đổi mật khẩu</a></li>
                        <li><a href="">Ngưng thuê</a></li>
                        <li><a href="">Vô hiệu hóa tài khoản</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Quản lý sản phẩm</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="">Sản phẩm</a></li>
                        <li><a href="">Nhóm sản phẩm</a></li>
                        <li><a href="">Tồn Kho</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Đơn hàng</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="">Đơn hàng</a></li>
                        <li><a href="">Vận chuyển</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Khách hàng</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="">Danh sách khách hàng</a></li>
                        <li><a href="">Phản hồi của khách hàng</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                    <form role="search" class="navbar-form-custom" method="post" action="#">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control"
                                   name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <!-- ?= $this->Flash->render() ?>
            <div class="">
                ?= $this->fetch('content') ?>
            </div>
            -->
        </div>
        <footer>
            <div class="footer">
                <div class="pull-right">
                    Online users: <strong>5</strong> users.
                </div>
                <div>
                    <strong>Copyright</strong> Zinza Technology &copy; 2016-
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Mainly scripts -->
<script src="js/productManagement/bootstrap.min.js"></script>
<script src="js/productManagement/metisMenu/jquery.metisMenu.js"></script>
<script src="js/productManagement/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/productManagement/DateFormat/dateformat.min.js"></script>
<script src="js/productManagement/inspinia.js"></script>
<script src="js/productManagement/pace/pace.min.js"></script>
<script src="js/productManagement/dataTables/datatables.min.js"></script>
<script src="js/productManagement/select2/select2.full.min.js"></script>
<script src="js/productManagement/sweetalert/sweetalert.min.js"></script>
<script src="js/productManagement/footable/footable.all.min.js"></script>
<script src="js/productManagement/datapicker/jquery.datetimepicker.full.js"></script>
<script src="js/productManagement/ImageUpload/require.js')"
        data-main="js/productManagement/ImageUpload/main.min"></script>
</body>
</html>
