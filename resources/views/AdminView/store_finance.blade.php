@extends('AdminView.master')
@section('contentManager')
    <link href="source/assets/manage/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5 class="text-info">Danh sách giao dịch cần trả cho nhà cung cấp</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group" id="data_5">
                            {{ csrf_field() }}
                            <div class="ibox-content row">
                                <div class="col-sm-6">
                                    <label class="font-weight-bold">Hiển Thị theo ngày</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <span class="input-group-addon">Từ</span>
                                        <input type="text" class="input-sm form-control" name="start"
                                               value="{{$startDate}}"
                                               id="startDate"/>
                                        <span class="input-group-addon">đến</span>
                                        <input type="text" class="input-sm form-control" name="end" value="{{$endDate}}"
                                               id="endDate"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="font-weight-bold">Người quản lý</label>
                                    <select class="select2_moderator form-control" id="select_moderator">
                                        <option></option>
                                        <option value="0">Tất cả</option>
                                        @foreach($moderators as $moderator)
                                            <option value="{{$moderator->id}}" >{{$moderator->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-store-finance">
                                <thead>
                                <tr>
                                    <th data-priority="1">Mã đơn</th>
                                    <th data-priority="2">Người quản lý</th>
                                    <th data-priority="3">Doanh thu</th>
                                    <th data-priority="4">Lợi nhuận</th>
                                    <th>Ngày đặt hàng</th>
                                    <th data-priority="5">Ngày hoàn thành</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="space-30"></div>
                        <div>
                            <label class="text-info" style="font-size: larger">Doanh thu:</label><label style="font-size: larger"><span id="loadAmount"></span></label>
                            <br>
                            <label class="text-info" style="font-size: larger">Lợi nhuận:</label><label style="font-size: larger"><span id="loadBenefit"></span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('AdminView.popup_view_moderatorInfo')
    <script src="source/assets/manage/js/jquery-2.1.1.js"></script>
    <script src="source/assets/manage/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="source/assets/manage/js/plugins/select2/select2.full.min.js"></script>
    <!-- Custom and plugin javascript -->

    <script type="text/javascript" language="javascript">
        var start = document.getElementById('startDate').getAttribute('value');
        var end = document.getElementById('endDate').getAttribute('value');
        var moderator_id = document.getElementById('select_moderator').getAttribute('value');

        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        $(".select2_moderator").select2({
            placeholder: "Select a state",
            allowClear: true
        });
        $('#select_moderator').on('change', function () {
            moderator_id = this.value.trim();
            $('.dataTables-store-finance').DataTable().ajax.reload();
        });
        $('#startDate').on('change', function () {
            start = this.value.trim();
            $('.dataTables-store-finance').DataTable().ajax.reload();
        });
        $('#endDate').on('change', function () {
            end = this.value.trim();
            $('.dataTables-store-finance').DataTable().ajax.reload();
        });
        $(document).ready(function () {
            $('.dataTables-store-finance').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "stateSave": true,
                "stateDuration": -1,
                "order": [[5, 'desc']],
                "ajax": {
                    "url": "<?= route('store_financeData') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":
                        function (d) {
                            d.startDate = start,
                                d.endDate = end,
                                d.moderator_id = moderator_id,
                                d._token = "<?= csrf_token() ?>"
                        },
                },
                "columns": [
                    {
                        data: "order_id"
                    },
                    {
                        data: "moderator_name", orderable: false,
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a data-toggle='modal' data-target='#modal-form-view-moderator' data-html='" + oData.moderator_id + "' data-title='" + oData.moderator_name + "' data-animation='" + oData.moderator_phoneNumber + "' data-clearing='" + oData.moderator_email + "'data-placement='" + oData.moderator_address + "' class='text-success'><b>" + oData.moderator_name + "</b></a>");
                        },
                    },
                    {
                        data: "amount", orderable: false
                    },
                    {
                        data: "store_benefit",orderable: false
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "completed_at",
                    },
                ],
                columnDefs: [
                    {className: 'control'},
                    {orderable: false},
                    {responsivePriority: 1, targets: 0},
                    {responsivePriority: 2, targets: 1},
                    {responsivePriority: 3, targets: 2},
                    {responsivePriority: 4, targets: 3},
                    {responsivePriority: 5, targets: 5},
                ],
                "drawCallback": function( data ) {
                    $("#loadAmount").html("&nbsp;"+data.json.totalAmount+"đ");
                    $("#loadBenefit").html("&nbsp;"+data.json.totalBenefit+"đ");
                },
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