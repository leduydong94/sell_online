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

	public function add($item, $id, $qty = 1){
		$cart = ['quantity'=>0, 'price' => $item->unit_price, 'sale_price'=> $item->sale_price, 'item' => $item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$cart = $this->items[$id];
			}
		}
		// dd($cart);

		$cart['quantity'] = $cart['quantity'] + $qty;
		$cart['price'] = $item->unit_price * $cart['quantity'];
		$this->items[$id] = $cart;
		// dd(count($this->items));
		$this->totalQuantity = count($this->items);
		if ($item->sale_price != 0) {
			$this->totalPrice += $qty*$item->sale_price;
		} else {
			$this->totalPrice += $qty*$item->unit_price;
		}
	}	
	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['quantity']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQuantity--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['quantity']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		// $this->totalQuantity -= $this->items[$id]['quantity'];
		$this->totalQuantity--;
		if ($this->items[$id]['sale_price'] != 0) {
			$this->totalPrice -= $this->items[$id]['sale_price'];
		} else {
			$this->totalPrice -= $this->items[$id]['price'];
		}
		unset($this->items[$id]);
	}
}
