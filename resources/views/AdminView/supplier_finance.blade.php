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
                                    <label class="font-weight-bold">Trạng thái</label>
                                    <select class="select2_status form-control" id="select_status">
                                        <option></option>
                                        <option value="0">Tất cả</option>
                                        @foreach($status as $statusLine)
                                            <option value="{{$statusLine->id}}" >{{$statusLine->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-supplier-finance">
                                <thead>
                                <tr>
                                    <th data-priority="1">Mã đơn</th>
                                    <th data-priority="3">Nhà cung cấp</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th data-priority="5">Số tiền</th>
                                    <th data-priority="6">Trạng thái</th>
                                    <th data-priority="4">Hạn thanh toán</th>
                                    <th data-priority="2">Hành Động</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('AdminView.popup_view_orderLine')
    @include('AdminView.popup_view_supplier_bankInfo')
    <script src="source/assets/manage/js/jquery-2.1.1.js"></script>
    <script src="source/assets/manage/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="source/assets/manage/js/plugins/select2/select2.full.min.js"></script>
    <!-- Custom and plugin javascript -->

    <script type="text/javascript" language="javascript">
        var start = document.getElementById('startDate').getAttribute('value');
        var end = document.getElementById('endDate').getAttribute('value');
        var status = document.getElementById('select_status').getAttribute('value');

        $(".select2_status").select2({
            placeholder: "Select a state",
            allowClear: true
        });

        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });
        $('#select_status').on('change', function () {
            status = this.value.trim();
            $('.dataTables-supplier-finance').DataTable().ajax.reload();
        });
        $('#startDate').on('change', function () {
            start = this.value.trim();
            $('.dataTables-supplier-finance').DataTable().ajax.reload();
        });
        $('#endDate').on('change', function () {
            end = this.value.trim();
            $('.dataTables-supplier-finance').DataTable().ajax.reload();
        });
        $(document).ready(function () {
            $('.dataTables-supplier-finance').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "stateSave": true,
                "stateDuration": -1,
                "order": [[0, 'desc']],
                "ajax": {
                    "url": "<?= route('supplier_financeData') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":
                        function (d) {
                            d.startDate = start,
                                d.endDate = end,
                                d.statusId = status,
                                d._token = "<?= csrf_token() ?>"
                        }
                },
                "columns": [
                    {
                        data: "order_code",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a data-toggle='modal' data-target='#modal-form-view' data-html='" + oData.product_name + "' data-title='" + oData.product_id + "' data-animation='" + oData.salePrice + "' data-clearing='" + oData.quantity + "'data-placement='" + oData.amountLine + "' class='text-success'><b>" + oData.order_code + "</b></a>");
                        },
                    },
                    {
                        data: "supplier_name", orderable: false,
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a data-toggle='modal' data-target='#modal-form-view-bank' data-html='" + oData.supplier_bank_name + "' data-title='" + oData.supplier_bank_branch + "' data-animation='" + oData.supplier_bank_username + "' data-clearing='" + oData.supplier_card_number + "'data-placement='" + oData.supplier_name + "' class='text-success'><b>" + oData.supplier_name + "</b></a>");
                        },
                    },
                    {
                        data: "supplier_address",
                        orderable: false
                    },
                    {
                        data: "supplier_phoneNumber", orderable: false
                    },
                    {
                        data: "amount", orderable: false
                    },
                    {
                        data: "payment_status_name",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            if (oData.payment_status == 1) {
                                $(nTd).html("<p class='text-warning'><b>" + oData.payment_status_name + "</b></p>");
                            } else if (oData.payment_status == 2) {
                                $(nTd).html("<p class='text-success'><b>" + oData.payment_status_name + "</b></p>");
                            } else {
                                $(nTd).html("<p class='text-danger'><b>" + oData.payment_status_name + "</b></p>");
                            }
                        }, orderable: false
                    },
                    {
                        data: "payment_date",
                    },
                    {
                        data: "orderLine_id",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            if (oData.payment_status == 1 || oData.payment_status == 3) {
                                $(nTd).html("<center><a class='btn btn-primary' herf='' id='" + oData.orderLine_id + "' name='" + oData.order_code + "' onclick='sendFunction(this.id,this.name)'>Thanh Toán</a></center>");
                            } else {
                                $(nTd).html("<center><a class='btn btn-primary' herf='' id='" + oData.orderLine_id + "' name='" + oData.order_code + "' onclick='sentFunction(this.id,this.name)'>Thanh Toán</a></center>");
                            }

                        }, orderable: false
                    },


                ],
                columnDefs: [
                    {className: 'control'},
                    {orderable: false},
                    {responsivePriority: 1, targets: 0},
                    {responsivePriority: 2, targets: -1},
                    {responsivePriority: 3, targets: 1},
                    {responsivePriority: 4, targets: 6},
                    {responsivePriority: 5, targets: 4},
                    {responsivePriority: 6, targets: 5},
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

        function sendFunction(id, name) {
            event.preventDefault(); // prevent form submit
            swal({
                    title: "Xác nhận chuyển tiền mã đơn " + name + "?",
                    text: "Bạn không thể quay lại! Hãy chắc chắn việc chuyển tiền!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Chuyển",
                    cancelButtonText: "Hủy bỏ",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('paymentForSupplierAjax') }}",
                            method: "POST",
                            dataType: "json",
                            data: {
                                "_token": "<?= csrf_token() ?>",
                                id: id
                            },
                            success: function (data) {
                                if (data.error.length > 0) {
                                    swal('Cancelled', "Đã có lỗi xảy ra!", "error");
                                }
                                else {
                                    swal("Success", "Bạn đã xác nhận chuyển mã đơn hàng " + name, "success");
                                    $('.dataTables-supplier-finance').DataTable().ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Việc chuyển tiền bị hủy bỏ", "error");
                    }
                });
        }

        function sentFunction(id, name) {
            event.preventDefault(); // prevent form submit
            swal({
                title: "Đơn hàng " + name + " đã được thanh toán trước đó!",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Quay lại",
                closeOnConfirm: true,
            });
        }
    </script>


@endsection