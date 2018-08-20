<div id="modal-form" class="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" id="edit_product_form" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-auto"><h3 class="m-t-none m-b">Mã sản phẩm <span id="id_title" class="text-navy"></span>
                            </h3>
                                <input type="hidden" id="productId" value="" required>
                                <div class="form-group"><label>Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="name" id="name" value="" required>
                                </div>
                                <div class="form-group"><label>Số lượng</label>
                                    <input class="qty-input form-control" id="quantity" name="quantity" type="number"
                                           value="" min="0" required/>
                                </div>
                                <div class="form-group"><label>Giá</label>
                                    <input type="number" class="form-control" name="price" id="price" required>
                                </div>
                                <div class="form-group"><label>Giảm(%)</label>
                                    <input class="qty-input form-control" id="discount" name="discount" type="number"
                                           value="" max="99" min="0" required/>
                                </div>
                        </div>
                        <span id="form_output"></span>
                    </div>
                    <div class="space-5"></div>
                    <div class="row">
                        <button class="btn btn-sm btn-primary" type="submit"><strong>Cập nhật</strong></button>
                        <button class="btn btn-sm btn-primary" data-dismiss="modal"><strong>Hủy</strong></button>
                    </div>
                </form>
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

    $('#modal-form').on('show.bs.modal', function (event) {
        $('body').css('padding-right','0px');
        var link = $(event.relatedTarget)
        var id = link.data('title')
        var name = link.data('html')
        var quantity = link.data('abide')
        var price = link.data('content')
        var discount = link.data('animation')
        var modal = $(this)
        modal.find('#productId').val(id);
        modal.find('#name').val(name);
        modal.find('#quantity').val(quantity);
        modal.find('#price').val(price);
        modal.find('#discount').val(discount);
        $('#form_output').html('');
    })

    $('#edit_product_form').on('submit', function(event){
        $('#form_output').html('');
        var id = document.getElementById('productId').getAttribute('value');
        event.preventDefault();
        var form_data = $(this).serialize();
        form_data = form_data + '&id='+id;
        console.log(form_data)
        $.ajax({
            url:"{{ route('editProductAjax') }}",
            method:"POST",
            dataType:"json",
            data:form_data,
            success:function(data)
            {
                if(data.error.length > 0)
                {
                    $('#form_output').html(data.error);
                }
                else
                {
                    $('#form_output').html(data.success);
                    $('.dataTables-productOfSp').DataTable().ajax.reload();
                }
            }
        })

    });
</script>




