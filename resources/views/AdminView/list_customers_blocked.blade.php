@extends('AdminView.master')
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
                        <h5>Danh Sách Người Sử Dụng</h5>
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
                                    <th>Mã Tài Khoản</th>
                                    <th>Họ và Tên</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Nhiệm Vụ</th>
                                    <th>Thời Gian Tạo</th>
                                    <th>Thời Gian Cập Nhật</th>
                                    <th>Trạng Thái</th>
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
        $(document).ready(function () {
            $('.dataTables-example').DataTable({

                "processing": true,
                "serverSide": true,
                "responsive": true,
                "stateSave": true,
                "stateDuration": -1,
                "ajax": {
                    "url": "<?= route('getListUsersBlocked',['id' => 3]) ?>",
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
                            data: "name", orderable: false
                        },
                        {
                            data: "phone", orderable: false
                        },
                        {
                            data: "status",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                if (oData.status == 2) {
                                    $(nTd).html("<span class='text-success'><b>Nhà Cung Cấp</b></span>");
                                }
                                if (oData.status == 3) {
                                    $(nTd).html("<span style='color: #1AB394' '><b>Khách Hàng</b></span>");
                                }
                                if (oData.status == 4) {
                                    $(nTd).html("<span class='text-danger'><b>Quản Trị Viên</b></span>");
                                }
                            }, orderable: false
                        },
                        {
                            data: "created_at"
                        },
                        {
                            data: "updated_at"
                        },
                        {
                            data: "delete_flag",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                $(nTd).html("<span class='text-danger'><b>"+oData.delete_flag+"</b></span>");
                            }
                            ,orderable:false
                        },
                        {
                            data: "id",
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
//                                $(nTd).html("<span type='text' onclick='getConfirmation("+ oData.id+")'><center><a class='text-danger' href=''><b>Khóa</b></a></center></span>");
                                $(nTd).html( "<center><a type='button' href='' class='btn btn-primary' onclick='getConfirmation(" + oData.id+")'>Mở Khóa</a></center>");
                            },
                            orderable:false
                        }

                    ]
            });
        });
        function getConfirmation(id) {
            event.preventDefault(); // prevent form submit
            swal({
                title: "Xác Nhận Khóa Tài Khoản?",
                text: "Bạn có muốn khóa tài khoản số: "+id+"!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Đúng, Tối muốn khóa!",
                cancelButtonText: "Sai, Hủy bỏ!",
                closeOnConfirm: false,
                closeOnCancel: false
            },function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ route('blockAccountByAdmin') }}",
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
                                swal("Thành Công","Đã xóa sản phẩm có mã "+id,"success");
                                $('.dataTables-example').DataTable().ajax.reload();
                            }
                        }
                    })
                } else {
                    swal("Hủy", "Bạn đã hủy thao tác thành công :)", "error");
                }
            });
        }
    </script>

@endsection