<?php
    include '_mysql.php';

    if(isset($_POST['mail']) && !empty($_POST['mail']) &&
       isset($_POST['password']) && !empty($_POST['password'])) {
        $sql = 'SELECT mdp, id FROM comptes WHERE mail="' . $_POST['mail'] . '" ';
        $result = sql_request($sql);

        while($data = $result->fetch_assoc()) {
            if($data['mdp'] == $_POST['password']) {
                echo "true";

                session_start();
                $_SESSION['user_id'] = $data['id'];
                $_SESSION['user_password'] = $data['mdp'];

                return;
            }
            else {
                echo "false";
                return;
            }
          }

        echo "false";
    }
?>