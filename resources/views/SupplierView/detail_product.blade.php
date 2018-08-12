@extends('SupplierView.productManagement')
@section('contentManager')
<link href="css/css-detail-product.css" rel="stylesheet">

<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div cass="row">
        <div class="form-card">
            <div class="row-product">
                <div class='form-group'>
                    <div class="col-sm-6">
                        <label class="control-label col-sm-12" for="name-input-field" id="product-label">Product Name</label>
                        <div class="col-sm-12" id="label-product">DSLR Camera</div>
                        <div class="col-sm-6" id="list-product-desc-3">
                            <label class="control-label">Product Quantity</label>
                            <select name="quantity" class="form-control locked" id="product-qty">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Product Price</label>
                            <div class="product-price">Rp. <strong class="" id="calc-product-price">5225000</strong></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="product-image">
                            <img src="https://managix.id/tools/landingpage/assets/images/uploads/WfsIjPwCqtJiB9f.jpeg" style="width: 100%"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection