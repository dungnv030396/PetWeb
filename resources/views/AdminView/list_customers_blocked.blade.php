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
                        <h5 class="text-info">Danh Sách Khách Hàng Bị Khóa</h5>
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
                                    <th data-priority="1">Mã</th>
                                    <th>Họ và Tên</th>
                                    <th>Số Điện Thoại</th>
                                    <th data-priority="3">Email</th>
                                    <th>Thời Gian Tạo</th>
                                    <th>Thời Gian Cập Nhật</th>
                                    <th data-priority="4">Trạng Thái</th>
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
                "order": [[5, 'desc']],
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
                            data: "name"
                        },
                        {
                            data: "phone"
                        },
                        {
                            data: "email"
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
                                $(nTd).html( "<center><a type='button' href='' class='btn btn-primary' id="+oData.id+" name="+oData.email+" onclick='getConfirmation(this.id,this.name)'>Mở Khóa</a></center>");
                            },
                            orderable:false
                        }

                    ],
                columnDefs: [
                    {className: 'control'},
                    {orderable: false},
                    {responsivePriority: 1, targets: 0},
                    {responsivePriority: 2, targets: -1},
                    {responsivePriority: 3, targets: 3},
                    {responsivePriority: 4, targets: 6},
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
        function getConfirmation(id,email) {
            event.preventDefault(); // prevent form submit
            swal({
                title: "Xác Nhận Mở Khóa Tài Khoản?",
                text: "Bạn có muốn khóa tài khoản: "+email+"",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Đúng, Thực hiện!",
                cancelButtonText: "Sai, Hủy bỏ!",
                closeOnConfirm: false,
                closeOnCancel: false
            },function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ route('unblockAccountByAdmin') }}",
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
                                swal("Thành Công","Đã mở tài khoản "+email,"success");
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