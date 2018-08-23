@extends('SupplierView.productManagement')
@section('contentManager')
    <link href="source/assets/manage/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5 class="text-info">Danh sách sản phẩm đang thực hiện</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-orderProduct">
                                <thead>
                                <tr>
                                    <th data-priority="1">Mã đơn</th>
                                    <th data-priority="3">Mã SP</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th data-priority="4">Số Lượng</th>
                                    <th data-priority="6">Tổng</th>
                                    <th data-priority="5">Trạng thái</th>
                                    <th>Kho</th>
                                    <th>Địa chỉ</th>
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
    </div>
    @include('SupplierView.popup_view_orderLine')
    <script src="source/assets/manage/js/jquery-2.1.1.js"></script>
    <!-- Custom and plugin javascript -->
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            $('.dataTables-orderProduct').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "stateSave": true,
                "stateDuration": -1,
                "order": [[ 0, 'desc' ]],
                "ajax": {
                    "url": "<?= route('dataSupplierPostOrderProducts') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data": {"_token": "<?= csrf_token() ?>"}
                },
                "columns": [
                    {
                        data: "order_code",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a data-toggle='modal' data-target='#modal-form-view' data-title='" + oData.catalog + "' data-html='" + oData.category + "' data-abide='" + oData.price + "' data-content='" + oData.discount + "' data-animation='" + oData.salePrice + "' data-clearing='" + oData.warehouse + "'data-placement='" + oData.warehouse_address + "' class='text-success'><b>" + oData.order_code + "</b></a>");
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
                        data: "amount", orderable: false
                    },
                    {
                        data: "status",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            if(oData.status_id==1){
                                $(nTd).html("<p class='text-warning'><b>"+oData.status+"</b></p>");
                            }else if(oData.status_id==2){
                                $(nTd).html("<p class='text-info'><b>"+oData.status+"</b></p>");
                            }else if(oData.status_id==3){
                                $(nTd).html("<p class='text-navy'><b>"+oData.status+"</b></p>");
                            }else if(oData.status_id==4){
                                $(nTd).html("<p class='text-danger'><b>"+oData.status+"</b></p>");
                            }else{
                                $(nTd).html("<a href='<?php echo 'a'?>' class='bg-success'>"+oData.status+"</a>");
                            }
                        },orderable:false
                    },
                    {
                        data: "warehouse", orderable: false
                    },
                    {
                        data: "warehouse_address", orderable: false
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "sent_at"
                    },
                    {
                        data: "orderLine_id",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            if(oData.status_id == 1){
                                $(nTd).html("<center><a class='btn btn-primary' herf='' id='" + oData.orderLine_id + "' name='"+ oData.order_code +"' onclick='sendFunction(this.id,this.name)'>Gửi</a></center>");
                            }else{
                                $(nTd).html("<center><a class='btn btn-primary' herf='' id='" + oData.orderLine_id + "' name='"+ oData.order_code +"' onclick='sentFunction(this.id,this.name)'>Gửi</a></center>");
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
                    { responsivePriority: 5, targets: 5 },
                    { responsivePriority: 6, targets: 4 },
                ],
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
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

        function sendFunction(id,name) {
            event.preventDefault(); // prevent form submit
            swal({
                    title: "Bạn chắc chắn đã chuyển đơn hàng "+name+"?",
                    text: "Bạn không thể sửa lại trạng thái! Hãy chắc chắn bạn đã chuyển hàng!",
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
                            url: "{{ route('sentProductAjax') }}",
                            method: "POST",
                            dataType: "json",
                            data: {
                                "_token":"<?= csrf_token() ?>",
                                id: id
                            },
                            success: function (data) {
                                if(data.error.length > 0)
                                {
                                    swal('Cancelled',"Đã có lỗi xảy ra!","error");
                                }
                                else
                                {
                                    swal("Success","Bạn đã xác nhận chuyển mã đơn hàng "+name,"success");
                                    $('.dataTables-orderProduct').DataTable().ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
        }

        function sentFunction(id,name) {
            event.preventDefault(); // prevent form submit
            swal({
                    title: "Đơn hàng "+name+" đã được bạn xác nhận trước đó!",
                    text: "Bấm 'Yes, got it!' để quay lại!",
                    type: "warning",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, got it!",
                    closeOnConfirm: true,
                });
        }
    </script>


@endsection