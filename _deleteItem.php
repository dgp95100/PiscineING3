<?php
    include '_mysql.php';

    if(isset($_POST['id']) && !empty($_POST['id'])) {
        session_start();

        $sql = 'DELETE FROM items WHERE id=' .$_POST['id'];
        sql_request($sql);

        echo "true";
    }
?>