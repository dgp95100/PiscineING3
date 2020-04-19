<?php
    include '_mysql.php';

    session_start();

    $singlepost = $_POST['singleitem'] == 'false' ? false : $_POST['singleitem'];

    $user_id = $_SESSION['user_id'];

    $sql = 'SELECT solde FROM comptes WHERE id=' . $user_id;
    $data = get_sql_object($sql);
    $solde = $data['solde'];

    if($singlepost == false) {
        $items = $_SESSION['cart'];
    } else {
        $items = array($singlepost);
    }

    $total = 0;
    for($i = 0; $i < count($items); $i++) {
        $sql = 'SELECT prix FROM items WHERE id=' . $items[$i];

        $data = get_sql_object($sql);
        
        $total += $data['prix'];
    }
    
    if($solde < $total) {
        echo $total - $solde;
    } else {
        $sql = 'SELECT items FROM comptes WHERE comptes.id=' . $user_id;
        $data = get_sql_object($sql);
        $solde -= $total;

        if($data['items'] == '') {
            $item_array = $items;
        } else {
            $item_array = array_merge(unserialize($data['items']), $items);
        }
        
        $sql = "UPDATE comptes SET items = '" . serialize($item_array) . "' WHERE id=" . $user_id;
        sql_request($sql);

        $sql = "UPDATE comptes SET solde = '" . $solde . "' WHERE id=" . $user_id;
        sql_request($sql);

        for($i = 0; $i < count($items); $i++) {
            $sql = 'SELECT * FROM items WHERE id=' . $items[$i];
            $item_data =  get_sql_object($sql);

            $id_vendeur = $item_data['vendeur'];
            $prix_item = $item_data['prix'];

            $sql = 'SELECT solde FROM comptes WHERE id=' . $id_vendeur;
            $solde_vendeur = get_sql_object($sql)['solde'];

            $sql = 'UPDATE comptes SET solde ="' . ($solde_vendeur + $prix_item) . '" WHERE id=' . $id_vendeur;
            sql_request($sql);
            $sql = 'UPDATE items SET statut="vendu" WHERE id=' . $items[$i];
            sql_request($sql);            
        }

        if($singlepost == false) {
            $_SESSION['cart'] = array();
        }

        echo "true";
    }
?>