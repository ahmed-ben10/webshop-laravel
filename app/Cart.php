<?php

namespace App;
use App\Order_Product;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function addToCart($item, $id){
        $productItem = [
            'product'=>$item,
            'quantity'=> 0,
            'price' => 0]
        ;
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $productItem = $this->items[$id];
            }
        }
        $productItem['quantity']++;
        $productItem['price'] = $item->price;
        $this->items[$id] = $productItem;
        $this->totalQty++;
        $this->calculateTotalPrice();
    }

    public function changeQuantity($id, $newQuantity){
        $quantity = $this->items[$id]["quantity"];
        $this->items[$id]["quantity"] = $newQuantity;
        $this->totalQty += $newQuantity - $quantity;
        $this->calculateTotalPrice();
    }

    public function deleteItem($id){
        $this->totalQty -= $this->items[$id]["quantity"];
        unset($this->items[$id]);
        $this->calculateTotalPrice();
    }


    public function calculateTotalPrice(){
        $this->totalPrice = 0;
        foreach ($this->items as $item) {
            $this->totalPrice += ($item['quantity'] * $item['price']);
        }
    }

    public function makeProductOrder($order_product){
        foreach ($this->items as $item) {
            $order_product->quantity = $item['quantity'];
            $order_product->product_id = $item['product']->id;
        }
        return $order_product;
    }
}
