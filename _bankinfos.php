<?php
    class BankInfos {
        public $type;
        public $number;
        public $name;
        public $expiration;
        public $code;

        function __construct($data) {
            if($data == null) {
                return;
            }

            $arr = unserialize($data);

            $this->type = $arr['cardtype'];
            $this->number = $arr['cardnumber'];
            $this->name = $arr['cardname'];
            $this->expiration = $arr['cardexpiration'];
            $this->code = $arr['cardcode'];
        }
    }
?>