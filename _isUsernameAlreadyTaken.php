<?php
    include '_mysql.php';

    if(isset($_POST['name']) && !empty($_POST['name'])) {
        $sql = 'SELECT * FROM comptes WHERE pseudo="' . $_POST['name'] . '" ';
        $result = sql_request($sql);

        while($data = $result->fetch_assoc()) {
            echo "true";
            return;
          }

        echo "false";
    }
?>