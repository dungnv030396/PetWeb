<div id="modal-form" class="modal fade" aria-hidden="true">
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
                        <button class="btn btn-sm btn-primary" type="submit"><strong>Hủy</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="source/assets/manage/js/jquery-2.1.1.js"></script>
<script>
    $('#edit_product_form').on('submit', function(event){
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



