<?php

    include '_item.php';

    function updateAllBids() {

        $sql = 'SELECT NOW()';
        $current_date = get_sql_object($sql)['NOW()'];

        $sql = 'SELECT * FROM items WHERE echeance<NOW()';
        $result = sql_request($sql);

        while($data = $result->fetch_assoc()) {
            $item = new Item($data);

            if(!in_array("enchere", $item->sell_type) || $item->status == "vendu") {
                continue;
            }

            $sql = 'SELECT MAX(prix), acheteur FROM transactions WHERE type="enchere" AND item=' . $item->id;
            $max_price = get_sql_object($sql)['MAX(prix)'];
            $buyer = get_sql_object($sql)['acheteur'];

            if($max_price != null) {
                $sql = 'SELECT MAX(prix) FROM transactions WHERE type="enchere" AND item=' . $item->id . ' AND prix!= ' . $max_price;
                $second_max_price = get_sql_object($sql)['MAX(prix)'];

                if($second_max_price == null) {
                    $second_max_price = $item->min_price;
                }

                $sell_price = $second_max_price + 1;

                $sql = 'DELETE FROM transactions WHERE item=' . $item->id;
                sql_request($sql);

                $sql = 'UPDATE items SET prix="' . $sell_price . '", statut="vendu" WHERE id=' . $item->id;
                sql_request($sql);

                $sql = 'UPDATE comptes SET solde=solde-' . $sell_price . ' WHERE id=' . $buyer;
                sql_request($sql);

                $sql = 'UPDATE comptes SET solde=solde+' . $sell_price . ' WHERE id=' . $item->seller;
                sql_request($sql);

                $sql = 'SELECT items FROM comptes WHERE id=' . $buyer;
                $data = get_sql_object($sql)['items'];

                if($data == '') {
                    $buyer_items = array();
                } else {
                    $buyer_items = unserialize($data);
                }

                array_push($buyer_items, $item->id);

                $sql = 'UPDATE comptes SET items="' . str_replace('"', '\"', serialize($buyer_items)) . '" WHERE id=' . $buyer;
                sql_request($sql);
            }
        }
    }
?>