@extends('SupplierView.productManagement')
@section('contentManager')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="source/assets/manage/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5 class="text-info">Danh Sách Sản phẩm</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-productOfSp">
                                <thead>
                                <tr>
                                    <th data-priority="1">Mã</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Loại</th>
                                    <th>Chủng loại</th>
                                    <th data-priority="3">Số Lượng</th>
                                    <th data-priority="6">Giá gốc</th>
                                    <th data-priority="5">Giảm Giá (%)</th>
                                    <th data-priority="4">Giá bán</th>
                                    <th>Ngày Đăng Bán</th>
                                    <th>Ngày Cập Nhật</th>
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
    @include('SupplierView.edit_product')
    <script src="source/assets/manage/js/jquery-2.1.1.js"></script>
    <!-- Custom and plugin javascript -->
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            $('.dataTables-productOfSp').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "stateSave": true,
                "stateDuration": -1,
                "order": [[ 0, 'desc' ]],
                "ajax": {
                    "url": "<?= route('dataSupplierPostProducts') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data": {"_token": "<?= csrf_token() ?>"}
                },
                "columns": [
                    {
                        data: "id",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<p class='text-navy'><b>" + oData.id + "</b></p>");
                        }
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "catalog", orderable: false
                    },
                    {
                        data: "category", orderable: false
                    },
                    {
                        data: "quantity"
                    },
                    {
                        data: "price"
                    },
                    {
                        data: "discount"
                    },
                    {
                        data: "salePrice", orderable: false
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "updated_at"
                    },
                    {
                        data: "id",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<center><a data-toggle='modal' data-target='#modal-form' data-title='" + oData.id + "' data-html='" + oData.name + "' data-abide='" + oData.quantity + "' data-content='" + oData.price_modal + "' data-animation='" + oData.discount + "' class='btn btn-primary'><i class='fa fa-pencil-square-o'>Sửa</i></a></center>"
                                + " " + "<center><a href='' class='btn btn-primary' id='" + oData.id + "' onclick='removeFunction(this.id)'><i class='fa fa-trash-o'>Xóa</i></a></center>"
                                + "");
                        }, orderable: false
                    },

                ],
                columnDefs: [
                    {className: 'control'},
                    {orderable: false},
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 },
                    { responsivePriority: 3, targets: 4 },
                    { responsivePriority: 4, targets: 7 },
                    { responsivePriority: 5, targets: 6 },
                    { responsivePriority: 6, targets: 5 },
                ],
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
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

        function removeFunction(id) {
            event.preventDefault(); // prevent form submit
            swal({
                    title: "Are you sure?",
                    text: "Dữ liệu sẽ được khóa trên server!",
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
                            url: "{{ route('removeProductAjax') }}",
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
                                    swal("Success","Đã xóa sản phẩm có mã "+id,"success");
                                    $('.dataTables-productOfSp').DataTable().ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
        }
    </script>


@endsection