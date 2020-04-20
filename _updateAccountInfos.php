<?php 
    include '_mysql.php';
    include '_address.php';

    if(isset($_POST['info_type']) && !empty($_POST['info_type'])) {
        session_start();

        if($_POST['info_type'] == 'user_info') {
            $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : null;
            $mail = isset($_POST['mail']) ? $_POST['mail'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;

            $sql = 'UPDATE `comptes` SET `pseudo` = "' . $pseudo . '", `mail` = "' . $mail . '", `mdp` = "' . $password . '" WHERE id=' . $_SESSION['user_id'];
            
            sql_request($sql);

            echo "true";
        } else if($_POST['info_type'] == 'user_address') {

            unset($_POST['info_type']);

            $sql = "UPDATE comptes SET adresse = '" . serialize($_POST) . "' WHERE id=" . $_SESSION['user_id'];

            sql_request($sql);

            echo "true";
        } else if($_POST['info_type'] == 'user_bank') {
            
            unset($_POST['info_type']);

            $sql = "UPDATE comptes SET infos_bancaires = '" . serialize($_POST) . "' WHERE id=" . $_SESSION['user_id'];

            sql_request($sql);

            echo "true";
        }
    }
?>