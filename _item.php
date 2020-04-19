<?php 

class Item {
    public $id;
    public $name;
    public $imgs;
    public $short_desc;
    public $long_desc;
    public $category;
    public $price;
    public $min_price;
    public $sell_type;
    public $seller;
    public $status;
    public $end_time;

    function __construct($data) {
        $this->id = $data['id'];
        $this->name = $data['nom'];
        $this->imgs = unserialize($data['photos']);
        $this->short_desc = $data['desc_courte'];
        $this->long_desc = $data['desc_longue'];
        $this->category = $data['categorie'];
        $this->price = $data['prix'];
        $this->min_price = $data['prix_min'];
        $this->sell_type = unserialize($data['type_vente']);
        $this->seller = $data['vendeur'];
        $this->status = $data['statut'];
        $this->end_time = $data['echeance'];
    }
}
?>