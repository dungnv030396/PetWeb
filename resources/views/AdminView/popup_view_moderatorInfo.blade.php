<div id="modal-form-view-moderator" class="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b" class="text-navy">Thông tin chi tiết</h3>
                        <div class="form-group"><label>Mã: </label>
                            <input type="text" class="form-control" id="moderator_id" value="" readonly>
                        </div>
                        <div class="form-group"><label>Họ tên: </label>
                            <input class="form-control" id="moderator_name" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Số điện thoại: </label>
                            <input class="form-control" id="moderator_phoneNumber" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Địa chỉ email: </label>
                            <input class="form-control" id="moderator_email" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Địa chỉ: </label>
                            <input type="text" class="form-control" id="moderator_address">
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
    $('#modal-form-view-moderator').on('hidden.bs.modal', function (event) {
        $('body').css('padding-right','0px');
    })
    $('#modal-form-view-moderator').on('show.bs.modal', function (event) {
        $('body').css('padding-right','0px');
        var link = $(event.relatedTarget)
        var moderator_name = link.data('title')
        var moderator_id = link.data('html')
        var moderator_phoneNumber = link.data('animation')
        var moderator_email = link.data('clearing')
        var moderator_address = link.data('placement')
        var modal = $(this)
        modal.find('#moderator_name').val(moderator_name);
        modal.find('#moderator_id').val(moderator_id);
        modal.find('#moderator_phoneNumber').val(moderator_phoneNumber);
        modal.find('#moderator_email').val(moderator_email);
        modal.find('#moderator_address').val(moderator_address);
    });

</script>





