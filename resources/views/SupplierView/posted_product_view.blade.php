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
                        <h5>User List Table</h5>
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
                                    <th>Mã</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Chủng loại</th>
                                    <th>Loại</th>
                                    <th>Số Lượng</th>
                                    <th>Giá gốc</th>
                                    <th>Giảm Giá (%)</th>
                                    <th>Giá bán</th>
                                    {{--<th style="width: 20%">Ảnh</th>--}}
                                    <th>Ngày Đăng Bán</th>
                                    <th>Ngày Cập Nhật</th>
                                    <th>Hành Động</th>
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
                "orderSequence": ["desc"],
                "targets": [0],
                "ajax": {
                    "url": "<?= route('dataSupplierPostProducts') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data": {"_token": "<?= csrf_token() ?>"}
                },
                "columns": [
                    {
                        data: "id"
                    },
                    {
                        data: "name",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='<?php echo 'a'?>'>" + oData.name + "</a>");
                        }
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
                        data: "updated_at"
                    },
                    {
                        data: "id",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a data-toggle='modal' data-target='#modal-form' data-title='" + oData.id + "' data-html='" + oData.name + "' data-abide='" + oData.quantity + "' data-content='" + oData.price_modal + "' data-animation='" + oData.discount + "' class='btn btn-primary'><i class='fa fa-pencil-square-o'>Edit</i></a>"
                                + " " + "<a href='' class='btn btn-primary' id='" + oData.id + "' onclick='removeFunction(this.id)'><i class='fa fa-trash-o'>Remove</i></a>"
                                + "");
                        }, orderable: false
                    },

                ],
                columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: [-2, -3, -8, -9]
                }]
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