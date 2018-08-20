<div id="modal-form-view" class="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <h3 class="text-info"><span>&nbsp;&nbsp;&nbsp;Thông tin chi tiết</span></h3>
                    <div class="col-sm-6 b-r">
                        <div class="form-group"><label>Mã SP: </label>
                            <input type="text" class="form-control" id="product_id" value="" readonly>
                        </div>
                        <div class="form-group"><label>Tên: </label>
                            <input class="form-control" id="product_name" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Giá: </label>
                            <input type="text" class="form-control" id="price" readonly>
                        </div>
                        <div class="form-group"><label>Giảm(%): </label>
                            <input class="form-control" id="discount" type="text" readonly/>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group"><label>Giá bán: </label>
                            <input class="form-control" id="salePrice" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Số lượng: </label>
                            <input class="form-control" id="quantity" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Tổng: </label>
                            <input class="form-control" id="amountLine" readonly/>
                        </div>
                        <div class="form-group"><label>Số tiền nhận được: </label>
                            <input class="form-control" id="amount" readonly/>
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
    $('#modal-form').on('hidden.bs.modal', function (event) {
        $('body').css('padding-right','0px');
    })
    $('#modal-form-view').on('show.bs.modal', function (event) {
        $('body').css('padding-right','0px');
        var link = $(event.relatedTarget)
        var product_id = link.data('title')
        var product_name = link.data('html')
        var discount = link.data('abide')
        var price = link.data('content')
        var salePrice = link.data('animation')
        var quantity = link.data('clearing')
        var amountLine = link.data('placement')
        var amount = link.data('hide')
        var modal = $(this)
        modal.find('#product_id').val(product_id);
        modal.find('#product_name').val(product_name);
        modal.find('#price').val(price);
        modal.find('#discount').val(discount);
        modal.find('#salePrice').val(salePrice);
        modal.find('#quantity').val(quantity);
        modal.find('#amountLine').val(amountLine);
        modal.find('#amount').val(amount);
    });

</script>





