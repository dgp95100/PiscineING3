<?php
    include '_mysql.php';

    if(isset($_POST['id']) && !empty($_POST['id'])) {
        session_start();

        if(!isset($_SESSION['cart'])) {
            echo "created and added to array";
            $_SESSION['cart'] = array($_POST['id']);
        } else if(in_array($_POST['id'], $_SESSION['cart'])) {
            echo "already in array";
        } else {
            echo "added to array";
            array_push($_SESSION['cart'], $_POST['id']);
        }

    }
?>