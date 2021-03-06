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
                        <h5 class="text-info">Danh sách đơn hàng</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   id="dataTables-example">
                                <thead>
                                <tr>
                                    <th data-priority="1">Mã Order</th>
                                    <th>Khách hàng</th>
                                    <th>Người quản lý</th>
                                    <th data-priority="3">Tình trạng đơn hàng</th>
                                    <th>Thời gian đặt hàng</th>
                                    <th data-priority="2">Hành động</th>
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
        $(document).ready(function () {
            $('.dataTables-example').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "stateSave": true,
                "stateDuration": -1,
                "order": [[ 0, 'desc' ]],
                "ajax": {
                    "url": "<?= route('orderDataProcessing') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data": {"_token": "<?= csrf_token() ?>"}
                },
                "columns":
                    [
                        {
                            data: "id",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                $(nTd).html("<span class='text-success'><b>" + oData.id + "</b><span>");
                            }
                        },
                        {
                            data: "user_name",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                $(nTd).html("<span class='text-primary'>" + oData.user_name + "<span>");
                            }, orderable: false
                        },
                        {
                            data: "moderator",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                $(nTd).html("<span class='text-primary'>" + oData.moderator + "<span>");
                            }, orderable: false
                        },
                        {
                            data: "status",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                if (oData.status_id == 1) {
                                    $(nTd).html("<p class='text-danger'><b>" + oData.status + "</b></p>");
                                } else if (oData.status_id == 2) {
                                    $(nTd).html("<p class='text-warning'><b>" + oData.status + "</b></p>");
                                } else if (oData.status_id == 3) {
                                    $(nTd).html("<p class='text-info'><b>" + oData.status + "</b></p>");
                                } else if (oData.status_id == 4) {
                                    $(nTd).html("<p class='text-success'><b>" + oData.status + "</b></p>");
                                } else {
                                    $(nTd).html("<p class='text-navy'><b>" + oData.status + "</b></p>");
                                }
                            }, orderable: false
                        },
                        {
                            data: "created_at"
                        },
                        {
                            data: "orderDetail", orderable: false
                        }
                    ],
                columnDefs: [
                    {className: 'control'},
                    {orderable: false},
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 },
                    { responsivePriority: 3, targets: 3 },

                ],
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]
            });
        });
    </script>

@endsection