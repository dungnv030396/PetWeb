@extends('ProductManagementViews.productManagement')
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
                                    <th>Mã Order</th>
                                    <th>Khách hàng</th>
                                    <th>Người quản lý</th>
                                    <th>Tình trạng đơn hàng</th>
                                    <th>Thời gian đặt hàng</th>
                                    <th>Hành động</th>
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
                    "url":"<?= route('orderDataProcessing') ?>",
                    "dataType" :"json",
                    "type": "POST",
                    "data":{"_token":"<?= csrf_token() ?>"}
                },
                "columns":
                    [
                        {data:"id"},
                        {
                            data:"user_name",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                $(nTd).html("<a href='{{}}'>"+oData.user_name+"</a>");
                            },orderable:false
                        },
                        {data:"moderator",orderable:false},
                        {data:"status",orderable:false},
                        {
                            data: "created_at"

                        },
                        {
                            data: "created_at",orderable:false

                        }
                    ]
            });
        });
    </script>

@endsection