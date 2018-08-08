@extends('SupplierView.productManagement')
@section('contentManager')

    <link href="source/assets/manage/css/plugins/datapicker/datepicker3.css" rel="stylesheet">


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Đăng Bán Sản Phẩm</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Trang Chủ</a>
                </li>
                <li>
                    <a>Quản Lí Gian hàng</a>
                </li>
                <li class="active">
                    <strong>Thêm sản phẩm</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">

        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">Thông Tin Sản Phẩm</a></li>
                        {{--<li class=""><a data-toggle="tab" href="#tab-2"> Data</a></li>--}}
                        {{--<li class=""><a data-toggle="tab" href="#tab-3"> Discount</a></li>--}}
                        {{--<li class=""><a data-toggle="tab" href="#tab-4"> Images</a></li>--}}
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <form method="post" action="{{route('addProduct')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <fieldset class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-2 control-label">Tên Sản Phẩm:</label>
                                        <div class="col-sm-10"><input name="productname" type="text" class="form-control"
                                                                      placeholder="Tên sản phẩm" required value="{{ old('productname') }}"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Chủng Loại:</label>
                                        <div class="col-sm-10"><select name="category" class="form-control-range">
                                                <option value="1">Chó</option>
                                                <option value="2">Mèo</option>
                                                <option value="3">Chim</option>
                                                <option value="4">Thức Ăn</option>
                                                <option value="5">Đồ Chơi</option>
                                                <option value="6">Quần Áo</option>
                                                <option value="7">Làm Đẹp</option>
                                                <option value="8">Trông Giữ</option>
                                                <option value="9">Chữa Trị</option>
                                                <option value="9">Đồ Dùng</option>
                                            </select></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Số Lượng:</label>
                                        <div class="col-sm-10"><input name="soluong" type="text" class="form-control"
                                                                      placeholder="" required value="{{ old('soluong') }}"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Giá:</label>
                                        <div class="col-sm-10"><input name="price" type="text" class="form-control"
                                                                      placeholder="VND" required value="{{ old('price') }}"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Khuyến Mãi:</label>
                                        <div class="col-sm-2"><input name="discount" type="text" class="form-control"
                                                                      placeholder="%" value="{{ old('discount') }}"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Mô Tả:</label>
                                        <div class="col-sm-10">
                                            <div>
                                                <h3>Nội dung</h3>
                                                <textarea class="form-control" name="description" placeholder="Mô tả sản phẩm" rows="5" required value="{{ old('description') }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Ảnh Mô Tả:</label>
                                        <div class="col-lg-8">
                                            <input style="float: left" type="file" class="text-center center-block well well-sm" name="avatar"required>
                                        </div>
                                    </div>
                                </fieldset>
                                    <button style="float: right; margin-right: 5%" class="btn btn-lg btn-info" type="submit">
                                        Đăng Bán
                                    </button>
                                </form>
                                <div class="form-group">

                                    @if (session('errorNull'))
                                        <div class="alert alert-danger">
                                            <ul>
                                                {{ session('errorNull') }}
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group">

                                    @if (session('errorFile'))
                                        <div class="alert alert-danger">
                                            <ul>
                                                {{ session('errorFile') }}
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group">
                                    @if (session('postProductSuccess'))
                                        <div class="alert alert-success">
                                            <ul>
                                                {{ session('postProductSuccess') }}
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

    </div>



    <script src="source/assets/manage/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <script>
        $(document).ready(function () {
            $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>
@endsection
