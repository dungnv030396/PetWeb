@extends('ModeratorView.master')
@section('contentManager')
    <link href="source/assets/manage/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5 class="text-navy">{{$warehouse->name}}</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-productWarehouse">
                                <thead>
                                <tr>
                                    <th data-priority="1">Mã đơn</th>
                                    <th data-priority="3">Mã SP</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th data-priority="4">Số Lượng</th>
                                    <th data-priority="5">Trạng thái</th>
                                    <th data-priority="6">Nhà cung cấp</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Ngày gửi</th>
                                    <th data-priority="2">Hành Động</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="{{$warehouse->id}}" id="warehouse_id">
    </div>
    @include('ModeratorView.popup_view_product')
    <script src="source/assets/manage/js/jquery-2.1.1.js"></script>
    <!-- Custom and plugin javascript -->
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            $('.dataTables-productWarehouse').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "stateSave": true,
                "stateDuration": -1,
                "order": [[ 0, 'desc' ]],
                "ajax": {
                    "url": "<?= route('productToWarehouse') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        "_token": "<?= csrf_token() ?>",
                        "warehouse_id": document.getElementById('warehouse_id').getAttribute('value')
                    }
                },
                "columns": [
                    {
                        data: "order_code",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a data-toggle='modal' data-target='#modal-form-view' data-title='" + oData.catalog + "' data-html='" + oData.category + "' data-abide='" + oData.price + "' data-content='" + oData.discount + "' data-animation='" + oData.salePrice + "' data-clearing='" + oData.supplier_name + "'data-placement='" + oData.supplier_address + "'data-page-size='" + oData.supplier_phoneNumber + "' class='text-success'><b>" + oData.order_code + "</b></a>");
                        },
                    },
                    {
                        data: "product_id", orderable: false
                    },
                    {
                        data: "product_name",
                        orderable: false
                    },
                    {
                        data: "quantity", orderable: false
                    },
                    {
                        data: "status",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            if (oData.status_id == 1) {
                                $(nTd).html("<p class='text-warning'><b>" + oData.status + "</b></p>");
                            } else if (oData.status_id == 2) {
                                $(nTd).html("<p class='text-info'><b>" + oData.status + "</b></p>");
                            } else if (oData.status_id == 3) {
                                $(nTd).html("<p class='text-navy'><b>" + oData.status + "</b></p>");
                            } else if (oData.status_id == 4) {
                                $(nTd).html("<p class='text-danger'><b>" + oData.status + "</b></p>");
                            }
                        }, orderable: false
                    },
                    {
                        data: "supplier_name", orderable: false
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "updated_at", orderable: false
                    },
                    {
                        data: "orderLine_id",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            if (oData.status_id == 2) {
                                $(nTd).html("<center><a class='btn btn-primary' herf='' id='" + oData.orderLine_id + "' name='" + oData.product_name +" trong mã đơn "+ oData.order_code + "' onclick='sendFunction(this.id,this.name)'><i class='fa fa-check'></i></a></center>");
                            } else if(oData.status_id == 1){
                                $(nTd).html("<center><a class='btn btn-primary' herf='' id='" + oData.orderLine_id + "' name='" + oData.product_name +" trong mã đơn "+ oData.order_code + "' onclick='sentFunction(this.id,this.name)'><i class='fa fa-check'></i></a><center>");
                            } else if(oData.status_id == 3){
                                $(nTd).html("<center><a class='btn btn-primary' herf='' id='" + oData.orderLine_id + "' name='" + oData.product_name +" trong mã đơn "+ oData.order_code + "' onclick='sent3Function(this.id,this.name)'><i class='fa fa-check'></i></a><center>");
                            }else{
                                $(nTd).html("<center><a class='btn btn-primary' herf='' id='" + oData.orderLine_id + "' name='" + oData.product_name +" trong mã đơn "+ oData.order_code + "' onclick='sent4Function(this.id,this.name)'><i class='fa fa-check'></i></a><center>");
                            }

                        }, orderable: false
                    },


                ],
                columnDefs: [
                    {className: 'control'},
                    {orderable: false},
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 },
                    { responsivePriority: 3, targets: 1 },
                    { responsivePriority: 4, targets: 3 },
                    { responsivePriority: 5, targets: 4 },
                    { responsivePriority: 6, targets: 5 },

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
                    title: "Bạn chắc chắn đã nhập kho sản phẩm " + name + "?",
                    text: "Bạn không thể sửa lại trạng thái! Hãy chắc chắn bạn đã nhập kho!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, archive it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('confirmProductToWarehouse') }}",
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
                                    $('.dataTables-productWarehouse').DataTable().ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
        }

        function sentFunction(id, name) {
            event.preventDefault(); // prevent form submit
            swal({
                title: "Sản phẩm " + name + " chưa được phía nhà cung cấp xác nhận đã xuất kho!",
                text: "Bấm 'Yes, got it!' để quay lại!",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, got it!",
                closeOnConfirm: true,
            });
        }
        function sent3Function(id, name) {
            event.preventDefault(); // prevent form submit
            swal({
                title: "Sản phẩm " + name + " đã được xác nhận trong kho trước đó!",
                text: "Bấm 'Yes, got it!' để quay lại!",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, got it!",
                closeOnConfirm: true,
            });
        }
        function sent4Function(id, name) {
            event.preventDefault(); // prevent form submit
            swal({
                title: "Sản phẩm " + name + " đang được ship!",
                text: "Bấm 'Yes, got it!' để quay lại!",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, got it!",
                closeOnConfirm: true,
            });
        }
    </script>


@endsection