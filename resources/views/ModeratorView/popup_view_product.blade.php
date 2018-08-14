<div id="modal-form-view" class="modal fade" aria-hidden="true">
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
                        <h3 class="m-t-none m-b" class="text-navy">Thông tin nhà cung cấp</h3>
                        <div class="form-group"><label>Tên: </label>
                            <input class="form-control" id="supplier_name" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Số điện thoại: </label>
                            <input class="form-control" id="supplier_phoneNumber" type="text" readonly/>
                        </div>
                        <div class="form-group"><label>Địa chỉ: </label>
                            <input class="form-control" id="supplier_address"/>
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
    $('#modal-form-view').on('show.bs.modal', function (event) {
        var link = $(event.relatedTarget)
        var catalog = link.data('title')
        var category = link.data('html')
        var price = link.data('abide')
        var discount = link.data('content')
        var salePrice = link.data('animation')
        var supplier_name = link.data('clearing')
        var supplier_address = link.data('placement')
        var supplier_phoneNumber = link.data('page-size')
        var modal = $(this)
        modal.find('#catalog').val(catalog);
        modal.find('#category').val(category);
        modal.find('#price').val(price);
        modal.find('#discount').val(discount);
        modal.find('#salePrice').val(salePrice);
        modal.find('#supplier_name').val(supplier_name);
        modal.find('#supplier_address').val(supplier_address);
        modal.find('#supplier_phoneNumber').val(supplier_phoneNumber);
    });

</script>





