<?php
    include '_mysql.php';

    if(isset($_POST['id']) && !empty($_POST['id'])) {
        session_start();

        array_splice($_SESSION['cart'], array_search($_POST['id'], $_SESSION['cart']), 1) ;

        echo "true";
    }
?>