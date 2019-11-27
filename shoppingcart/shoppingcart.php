<?php
require ('item.php');
// shopping cart class
 class shoppingcart {
     public $items = [];
     protected $quantity = 0;

    // set the items and add them to the shopping cart
     public function set_item($code,$name,$des,$price,$quantity) {
         $index = 0;
         for ($count = 0;$count < $quantity;$count++)
         {
             $index++;
             $this->add_item($code,$name,$des,$price,$quantity);
         }

     }
     // remove items from the shopping cart
     public function remove_items($code,$quantity) {
         $index = 0;
         for ($count = 0;$count < $quantity;$count++)
         {
             $index++;
             $this->remove_item($code);
         }

     }

    // get a lists of all the items in the shopping cart
     public function get_items() {
         $codes =[];
         $returnitems = [];
         foreach ($this->items as $item) {
             if (!(in_array($item['product']->get_itemcode(),$codes))) {
                 $codes[] = $item['product']->get_itemcode();
                 $returnitems[] = $item;
             }
         }
       return  $returnitems;


     }

     // get a list of all the item codes in the shooping cart
     public function get_itemcodes() {
          $itemcodes = [];
         foreach ($this->items as $item_code) {
             $itemcodes = array_unique(array_column($item_code,'item_code') );
         }
         return $itemcodes;

     }

     // add an item to the shooping cart if item already in there just increment the quantity
     public function add_item($code,$name,$des,$price,$quantity) {
         $new_item = new item($code,$name,$des,$price);
         $index = 0;

         if ((count($this->items)>0)) {
             foreach ($this->items as $item) {
                 if ($item['product']->get_itemcode() == $code) {
                     $this->items[$index]['quantity'] = $item['quantity'] + 1;
                 } else {
                     $itemcodes = $this->get_itemcodes() ;
                    // check if item exists otherwise insert new item
                    if (!(in_array($code,$itemcodes))) {
                        $this->items[] = array('product'=>$new_item->get_item(),'quantity' => 1);
                    }
                 }
                 $index++;
             }
         } else {
             // if new item exists create the first one
             $this->items[] = array('product'=>$new_item->get_item(),'quantity' => 1);
         }


     }
     // remove item from the shopping cart
     public function remove_item($code) {
         $index = 0;
         foreach ($this->items as $item) {
             if ($item['product']->get_itemcode()== $code) {
                 if ($item['quantity'] >1) {
                     $this->items[$index]['quantity'] = $item['quantity'] - 1;
                 } else {
                     unset($this->items[$index]);
                     $this->items =  array_values($this->items);
                  }
             }
             $index++;
         }

     }


 }
