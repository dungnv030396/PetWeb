<div id="modal-form-view" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="m-t-none m-b" class="text-navy">Thông tin quản lý</h3>
                        <div class="form-group"><label>Tên: </label>
                            <input class="form-control" id="name" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Số điện thoại: </label>
                            <input class="form-control" id="phoneNumber" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Địa chỉ email: </label>
                            <input class="form-control" id="email"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="source/assets/manage/js/jquery-2.1.1.js"></script>
<script src="source/assets/manage/js/bootstrap.min.js"></script>
<script>
    $('#modal-form-view').on('hidden.bs.modal', function (event) {
        $('body').css('padding-right','0px');
    })
    $('#modal-form-view').on('show.bs.modal', function (event) {
        $('body').css('padding-right','0px');
        var link = $(event.relatedTarget)
        var name = link.data('title')
        var email = link.data('abide')
        var phoneNumber = link.data('content')
        var modal = $(this)
        modal.find('#name').val(name);
        modal.find('#email').val(email);
        modal.find('#phoneNumber').val(phoneNumber);
    });
</script>





