<?php 

class User {
    public $id;
    public $pseudo;
    public $password;
    public $type;
    public $mail;
    public $items;
    public $balance;
    public $inscription;

    function __construct($data) {
        $this->id = $data['id'];
        $this->pseudo = $data['pseudo'];
        $this->type = $data['type'];
        $this->mail = $data['mail'];
        $this->password = $data['mdp'];
        $this->balance = $data['solde'];
        $this->items = unserialize($data['items']);
        $this->inscription = $data['date_inscription'];
    }
}

?>