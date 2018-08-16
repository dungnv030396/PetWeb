<div id="modal-form-view" class="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b" class="text-navy">Thông tin chi tiết</h3>
                        <div class="form-group"><label>Loại: </label>
                            <input type="text" class="form-control" id="catalog" value="" readonly>
                        </div>
                        <div class="form-group"><label>Chủng loại: </label>
                            <input class="form-control" id="category" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Giá: </label>
                            <input type="text" class="form-control" id="price" readonly>
                        </div>
                        <div class="form-group"><label>Giảm(%): </label>
                            <input class="form-control" id="discount" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Giá bán: </label>
                            <input class="form-control" id="salePrice" type="text" readonly/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="m-t-none m-b" class="text-navy">Thông tin kho hàng</h3>
                        <div class="form-group"><label>Tên: </label>
                            <input class="form-control" id="warehouse" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Địa chỉ: </label>
                            <input class="form-control" id="warehouse_address"/>
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
        var catalog = link.data('title')
        var category = link.data('html')
        var price = link.data('abide')
        var discount = link.data('content')
        var salePrice = link.data('animation')
        var warehouse = link.data('clearing')
        var warehouse_address = link.data('placement')
        var modal = $(this)
        modal.find('#catalog').val(catalog);
        modal.find('#category').val(category);
        modal.find('#price').val(price);
        modal.find('#discount').val(discount);
        modal.find('#salePrice').val(salePrice);
        modal.find('#warehouse').val(warehouse);
        modal.find('#warehouse_address').val(warehouse_address);
    });

</script>





