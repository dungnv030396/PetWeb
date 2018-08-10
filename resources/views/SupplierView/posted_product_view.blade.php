@extends('SupplierView.productManagement')
@section('contentManager')
    <link href="source/assets/manage/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>User List Table</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th style="width: 5%">Mã Sản Phẩm</th>
                                    <th style="width: 10%">Tên Sản Phẩm</th>
                                    {{--<th style="width: 5%">Chủng Loại</th>--}}
                                    <th style="width: 10%">Giá</th>
                                    <th style="width: 5%">Số Lượng</th>
                                    <th style="width: 5%">Giảm Giá (%)</th>
                                    {{--<th style="width: 20%">Ảnh</th>--}}
                                    <th style="width: 5%">Ngày Đăng Bán</th>
                                    <th style="width: 5%">Ngày Cập Nhật</th>
                                    <th style="width: 10%">Hành Động</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="source/assets/manage/js/jquery-2.1.1.js"></script>
    <!-- Custom and plugin javascript -->
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
            $('.dataTables-example').DataTable( {
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "stateSave": true,
                "stateDuration": -1,
                "ajax":{
                    "url":"<?= route('dataSupplierPostProducts') ?>",
                    "dataType" :"json",
                    "type": "POST",
                    "data":{"_token":"<?= csrf_token() ?>"}
                },
                "columns":
                    [
                        {data:"id"},
                        {
                            data:"name",
                            orderable:false
                        },
//                        {data:"category",orderable:false},
                        {data:"price"
                            ,orderable:false},
                        {data:"quantity",orderable:false},
                        {data:"discount",orderable:false},
//                        {data:"image_link",
//                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
//                                $(nTd).html("<img style='width: 100%;height: 15%' src = storage/products/" + oData.image_link + ">");
//                            }
//                        ,orderable:false
//                        },
                        {
                            data: "created_at"
                        },
                        {
                            data: "updated_at",orderable:false
                        },
                    {
                        data: "productDetail",orderable:false
                    }
                    ]
            });
        });
    </script>

@endsection