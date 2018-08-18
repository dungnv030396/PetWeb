<div id="modal-form-view" class="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b" class="text-navy">Thông tin chi tiết</h3>
                        <div class="form-group"><label>Mã sản phẩm: </label>
                            <input type="text" class="form-control" id="product_id" value="" readonly>
                        </div>
                        <div class="form-group"><label>Tên sản phẩm: </label>
                            <input class="form-control" id="product_name" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Số lượng: </label>
                            <input type="text" class="form-control" id="quantity" readonly>
                        </div>
                        <div class="form-group"><label>Giá bán: </label>
                            <input class="form-control" id="salePrice" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Tổng: </label>
                            <input class="form-control" id="amountLine" type="text" readonly/>
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
        var product_id = link.data('title')
        var product_name = link.data('html')
        var salePrice = link.data('animation')
        var quantity = link.data('clearing')
        var amountLine = link.data('placement')
        var modal = $(this)
        modal.find('#product_id').val(product_id);
        modal.find('#product_name').val(product_name);
        modal.find('#quantity').val(quantity);
        modal.find('#salePrice').val(salePrice);
        modal.find('#amountLine').val(amountLine);
    });

</script>





