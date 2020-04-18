<?php 

    include '_mysql.php';

    function validateCreditentials() {

        session_start();

        if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_password']) || $_SESSION['user_id'] == '' || $_SESSION['user_password'] == '') {
            header('Location: login.php?need_login');
            exit();
        }

        $sql = 'SELECT mdp, pseudo, type FROM comptes WHERE id = ' . $_SESSION['user_id'];
        $data = get_sql_object($sql);
        
        if($data['mdp'] !== $_SESSION['user_password']) {
            session_destroy();
            header('Location: login.php?need_login');
            exit();
        }

        $_SESSION['user_type'] = $data['type'];
        $_SESSION['user_name'] = $data['pseudo'];
    }
?>