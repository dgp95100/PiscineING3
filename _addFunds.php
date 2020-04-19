<?php
    include '_mysql.php';

    if(isset($_POST['amount']) && !empty($_POST['amount'])) {
        session_start();

        $sql = 'UPDATE comptes SET solde=solde+"' . $_POST['amount'] . '" WHERE id=' . $_SESSION['user_id'];
        sql_request($sql);
        header("Location: account.php?funds_added=" . $_POST['amount']);
    }
?>