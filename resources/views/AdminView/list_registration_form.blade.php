@extends('AdminView.master')
@section('contentManager')
    <link href="source/assets/manage/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @if(!empty(\Illuminate\Support\Facades\Session::get('accept')))
        @include('sweet::alert')
    @endif
    @if(!empty(\Illuminate\Support\Facades\Session::get('cancel')))
        @include('sweet::alert')
    @endif

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Danh Sách Phiếu Đăng Ký Trở Thành Nhà Cung Cấp</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Mã Phiếu</th>
                                    <th>Tên</th>
                                    <th>Địa Chỉ Email</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Thời gian gửi phiếu</th>
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
                    "url":"<?= route('registrationDataProcessing') ?>",
                    "dataType" :"json",
                    "type": "POST",
                    "data":{"_token":"<?= csrf_token() ?>"}
                },
                "columns":
                    [
                        {data:"id"},
                        {
                            data:"name",orderable:false
                        },
                        {
                            data:"email", orderable:false
                        },
                        {
                            data:"phone", orderable:false
                        },
                        {
                            data: "updated_at"
                        },
                        {
                            data: "detailRegistration",orderable: false
                        }
                    ]
            });
        });
    </script>

@endsection