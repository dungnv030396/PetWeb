@extends('ModeratorView.master')
@section('contentManager')
    <link href="source/assets/manage/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @if(!empty($message) && $message == 'true')
        @include('sweet::alert')
    @endif
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Danh Sách Báo Cáo Chờ Xử Lý</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Mã Report</th>
                                    <th>Tình Trạng</th>
                                    <th>Người quản lý</th>
                                    <th>Người báo cáo</th>
                                    <th>Người bị báo cáo</th>
                                    <th>ID Sản phẩm</th>
                                    <th>Thời gian báo cáo</th>
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
    <script src="source/assets/dest/js/DateFormat/dateformat.min.js"></script>
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
                "orderSequence": [ "desc" ],
                "targets": [0],
                "ajax":{
                    "url":"<?= route('reportDataProcessed') ?>",
                    "dataType" :"json",
                    "type": "POST",
                    "data":{"_token":"<?= csrf_token() ?>"}
                },
                "columns":
                    [
                        {data:"id"},
                        {
                            data:"status",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                if(oData.status==2){
                                    $(nTd).html("<a href='<?php echo 'a'?>'>Đúng</a>");
                                }
                                if(oData.status==3){
                                    $(nTd).html("<a href='<?php echo 'a'?>'>Sai</a>");
                                }
                            },orderable:false
                        },
                        {
                            data:"admin_name", orderable:false
                        },
                        {
                            data:"user_name", orderable:false
                        },
                        {
                            data:"reportTo_name", orderable:false
                        },
                        {
                            data:"product_id",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                if(oData.product_id==null){
                                    $(nTd).html("<a href='<?php echo 'a'?>'></a>");
                                }
                            }, orderable:false
                        },
                        {
                            data: "created_at",orderable:false
                        },
                        {
                            data: "detailReport",orderable: false
                        }
                    ]
            });
        });
    </script>

@endsection