<div class="your-order-item">
    <div>
        <!--  one item	 -->
        @if(Session::has('cart'))
            @foreach($cart->items as $product)
                <div class="media">
                    <img width="25%" src="storage/products/{{$product['item']->image_link}}" alt="" class="pull-left">
                    <div class="media-body">
                        <p class="font-large">{{$product['item']->name}}</p>
                        <span class="color-gray your-order-info">Giá:
                            @if($product['item']->discount != 0)
                                {{number_format($product['item']->price - (($product['item']->price * $product['item']->discount) / 100))}}
                                đ
                            @else
                                {{number_format($product['item']->price)}}đ
                            @endif
						</span>
                        <br>
                        <span class="color-gray your-order-info">Số lượng:
							<input class="form-block" id="{{$product['item']->id}}" name="quantity{{$product['item']->id}}" type="number" value="{{$product['quantity']}}" max="{{$product['item']->quantity}}" min="1" onchange="innerHtmlAjaxData(this)"/>
						</span>
                        <br>
                        <span class="color-gray your-order-info">Tổng: {{number_format($product['amountOfLine'])}}
                            đ</span>
                    </div>
                </div>
        @endforeach
    @endif
    <!-- end one item -->
    </div>
    <div class="clearfix"></div>
</div>
<div class="your-order-item">
    <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
    <div class="pull-right"><h5 class="your-order-item beta-sales-price">{{number_format($cart->totalPrice)}}đ</h5>
    </div>
    <div class="clearfix"></div>
</div>

