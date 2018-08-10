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
                                $(nTd).html("<a href='<?php echo 'a'?>'>"+oData.user_name+"</a>");
                            },orderable:false
                        },
                        {
                            data: "moderator",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                $(nTd).html("<a href='<?php echo 'a'?>'>" + oData.moderator + "</a>");
                            }, orderable: false
                        },
                        {
                            data:"status",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                if(oData.status_id==1){
                                    $(nTd).html("<a href='{{}}' class='bg-danger'>"+oData.status+"</a>");
                                }else if(oData.status_id==2){
                                    $(nTd).html("<a href='<?php echo 'a'?>' class='bg-warning'>"+oData.status+"</a>");
                                }else if(oData.status_id==3){
                                    $(nTd).html("<a href='<?php echo 'a'?>' class='bg-primary'>"+oData.status+"</a>");
                                }else if(oData.status_id==4){
                                    $(nTd).html("<a href='<?php echo 'a'?>' class='bg-info'>"+oData.status+"</a>");
                                }else{
                                    $(nTd).html("<a href='<?php echo 'a'?>' class='bg-success'>"+oData.status+"</a>");
                                }
                            },orderable:false
                        },
                        {
                            data: "created_at",
                            render: function (data, type, full, meta) {
                                return formatDate(data,'dd/MM/yyyy hh:mm:ss a');
                            }
                        },
                        {
                            data: "orderDetail",
                        }
                    ]
            });
        });
    </script>

@endsection