<?php

    class Address {
        public $name;
        public $lastname;
        public $address1;
        public $address2;
        public $city;
        public $postcode;
        public $country;
        public $phone;

        function __construct($data) {
            if($data == null) {
                return;
            }

            $arr = unserialize($data);

            $this->name = $arr['name'];
            $this->lastname = $arr['lastname'];
            $this->address1 = $arr['address1'];
            $this->address2 = $arr['address2'];
            $this->city = $arr['city'];
            $this->postcode = $arr['postcode'];
            $this->country = $arr['country'];
            $this->phone = $arr['phone'];
        }

        function serialize_object() {
            $arr = array();

            $arr['name'] = $this->name;
            $arr['lastname'] = $this->lastname;
            $arr['address1'] = $this->address1;
            $arr['address2'] = $this->address2;
            $arr['city'] = $this->city;
            $arr['postcode'] = $this->postcode;
            $arr['country'] = $this->country;
            $arr['phone'] = $this->phone;

            return serialize($arr);
        }
    }
?>