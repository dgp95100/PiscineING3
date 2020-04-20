<?php 

    include '_mysql.php';

    if(isset($_POST['input']) && !empty($_POST['input'])) {
        if($_POST['input'] == "accept") {
            acceptOffer();
        } else if($_POST['input'] == "refuse") {
            refuseOffer();
        } else if($_POST['input'] == "contre-offre") {
            updateOffer();
        } else if($_POST['input'] == "delete") {
            deleteOffer();
        }
        else {
            echo "false";
            return;
        }

        echo "true";
        return;
    }

    function acceptOffer() {
        $buyer_id = $_POST['buyer_id'];
        $seller_id = $_POST['seller_id'];
        $item_id = $_POST['item_id'];
        $price = $_POST['price'];

        // AJOUT DE L'ITEM AU TABLEAU D'ITEM DE L'ACHETEUR
        $sql = 'SELECT items FROM comptes WHERE id=' . $buyer_id;
        $data = get_sql_object($sql)['items'];

        if($data == '') {
            $buyer_items = array();
        } else {
            $buyer_items = unserialize($data);
        }

        array_push($buyer_items, $item_id);

        $sql = 'UPDATE comptes SET items="' . str_replace('"', '\"', serialize($buyer_items)) . '" WHERE id=' . $buyer_id;
        sql_request($sql);

        // PAIEMENT VENDEUR
        $sql = 'UPDATE comptes SET solde=solde+' . $price . ' WHERE id=' . $seller_id;
        sql_request($sql);

        // DECOMPTE ACHETEUR
        $sql = 'UPDATE comptes SET solde=solde-' . $price . ' WHERE id=' . $buyer_id;
        sql_request($sql);

        // STATUS "VENDU" pour ITEM
        $sql = 'UPDATE items SET statut="vendu" WHERE id=' . $item_id;
        sql_request($sql);

        // MISE A JOUR PRIX DE L'ITEM
        $sql = 'UPDATE items SET prix=' . $price . ' WHERE id=' .$item_id;
        sql_request($sql);
    }

    function updateOffer() {
        $new_offer = $_POST['amount'];

        $sql = 'UPDATE transactions SET prix=' . $new_offer . ', n_proposition=n_proposition+1 WHERE id=' . $_POST['offer_id'];
        sql_request($sql);

        header('Location: account.php#offers');
    }

    function refuseOffer() {
        $offer_id = $_POST['offer_id'];
        $value = $_POST['value'];

        $sql = 'UPDATE transactions SET n_proposition="' . $value . '" WHERE id=' . $offer_id;
        sql_request($sql);
    }

    function deleteOffer() {
        $offer_id = $_POST['offer_id'];

        $sql = 'DELETE FROM transactions WHERE id=' . $offer_id;
        sql_request($sql);
    }

    echo "false";
?>