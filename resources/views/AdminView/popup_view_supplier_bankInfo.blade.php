<div id="modal-form-view-bank" class="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b" class="text-navy">Thông tin chi tiết</h3>
                        <div class="form-group"><label>Nhà cung cấp: </label>
                            <input type="text" class="form-control" id="supplier_name" value="" readonly>
                        </div>
                        <div class="form-group"><label>Chủ tài khoản: </label>
                            <input class="form-control" id="supplier_bank_username" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Số tài khoản: </label>
                            <input class="form-control" id="supplier_card_number" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Ngân hàng: </label>
                            <input class="form-control" id="supplier_bank_name" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Chi nhánh: </label>
                            <input type="text" class="form-control" id="supplier_bank_branch" readonly>
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
    $('#modal-form-view-bank').on('hidden.bs.modal', function (event) {
        $('body').css('padding-right','0px');
    })
    $('#modal-form-view-bank').on('show.bs.modal', function (event) {
        $('body').css('padding-right','0px');
        var link = $(event.relatedTarget)
        var supplier_bank_branch = link.data('title')
        var supplier_bank_name = link.data('html')
        var supplier_bank_username = link.data('animation')
        var supplier_card_number = link.data('clearing')
        var supplier_name = link.data('placement')
        var modal = $(this)
        modal.find('#supplier_name').val(supplier_name);
        modal.find('#supplier_card_number').val(supplier_card_number);
        modal.find('#supplier_bank_username').val(supplier_bank_username);
        modal.find('#supplier_bank_name').val(supplier_bank_name);
        modal.find('#supplier_bank_branch').val(supplier_bank_branch);
    });

</script>





