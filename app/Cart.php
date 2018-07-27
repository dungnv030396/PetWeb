<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQuantity = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQuantity = $oldCart->totalQuantity;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($product, $quantity){
		$cart_line = ['quantity' => 0, 'amountOfLine' => $product->price, 'item' => $product];
		if($this->items){
			if(array_key_exists($product->id, $this->items)){
                $cart_line = $this->items[$product->id];
			}
		}
        $cart_line['quantity'] += $quantity;
		if($product->discount != 0){
		    $cart_line['amountOfLine'] = ($product->price - (($product->price * $product->discount) / 100)) * $cart_line['quantity'];
            $this->totalPrice += ($product->price - (($product->price * $product->discount) / 100)) * $quantity;
        }else{
            $cart_line['amountOfLine'] = $product->price * $cart_line['quantity'];
            $this->totalPrice += $product->price * $quantity;
        }
		$this->items[$product->id] = $cart_line;
		$this->totalQuantity += $quantity;
	}
	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQuantity--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQuantity -= $this->items[$id]['quantity'];
		$this->totalPrice -= $this->items[$id]['amountOfLine'];
		unset($this->items[$id]);
	}

}
