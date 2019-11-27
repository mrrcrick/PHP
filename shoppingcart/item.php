<?php
    // class item represents one item in the shopping cart
    class item {
        public $price = 0.00;
        public $name = '';
        public $description ='';
        public $item_code ='';

        // constructor
        public function __construct($setitemcode,$setname,$description,$setprice = 0.00)
        {
            $this->set_itemcode($setitemcode);
            $this->set_name($setname);
            $this->set_description($description);
            $this->set_price($setprice);
        }

        // set the item name
        public function set_name($name) {
            $this->name = $name;
        }
        // set the item price
        public function set_price($price) {
            $this->price = intval($price);
        }
        // set the item code
        public function set_itemcode($code)
        {
            $this->item_code = $code;
        }
        // set the item description
        public function set_description($des) {
            $this->description = $des;
        }
        // get the item code
        public function get_itemcode() {
            return $this->item_code;
        }
        // get the item name
        public function get_name() {
            return $this->name;
        }
        // get the item price
        public function get_price() {
            return $this->price;
        }
        // get the item Descripton
        public function get_description() {
            return $this->description;
        }
        // get the item
        public function get_item() {
            return $this;
        }

    }
