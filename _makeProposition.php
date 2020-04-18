<?php
    include '_mysql.php';

    if(isset($_POST['id']) && !empty($_POST['id']) &&
       isset($_POST['price']) && !empty($_POST['price'])) {
        session_start();

        $sql = 'INSERT INTO `transactions` (`id`, `type`, `item`, `acheteur`, `prix`, `n_proposition`) VALUES (NULL, "proposition", "' . $_POST['id'] . '", "' . $_SESSION['user_id'] . '", "' . $_POST['price'] . '", "1")';
        sql_request($sql);
    }
?>