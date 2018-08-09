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
                                    <div class="form-group"><label class="col-sm-2 control-label">Loại sản phẩm:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" onclick="innerHtmlAjaxData(this)" name="catalog">
                                            @foreach($catalogs as $catalog)
                                                <option value="{{$catalog->id}}">{{$catalog->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Chủng loại:</label>
                                        <div class="col-sm-10" id="loaddata">
                                            <select name="category" class="form-control" >
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Chủng loại khác:</label>
                                        <div class="col-sm-10"><input name="category_new" type="text" class="form-control" placeholder="Chủng loại khác nếu có"  value=""></div>
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
                                            <ul style="width: 50%;float: left">
                                                {{ session('errorNull') }}
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group">

                                    @if (session('errorFile'))
                                        <div style="width: 50%;float: left" class="alert alert-danger">
                                            <ul>
                                                {{ session('errorFile') }}
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group">
                                    @if (session('postProductSuccess'))
                                        <div style="width: 50%;float: left" class="alert alert-success">
                                            <ul>
                                                {{ session('postProductSuccess') }}
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div style="width: 50%;float: left" class="form-group">
                                    @include('layouts.errors')
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript" language="javascript" >
        function innerHtmlAjaxData(catalog){
            $.ajax({
                type: "POST",
                url: "{{route('loadCategories')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    id: catalog.value
                },
                success: function(data) {
                    $("#loaddata").html(data);
                }
            });
        }
    </script>
@endsection
