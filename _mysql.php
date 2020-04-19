<?php 
    function sql_request($sql) {
        $conn = new mysqli('localhost', 'root', '', 'ebay_ece');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn->query($sql);
    }

    function get_sql_object($sql) {
        $result = sql_request($sql);

        if($result == false) {
            return null;
        }

        while($data = $result->fetch_assoc()) {
            return $data;
          }
    }

    function get_last_id() {
        $link = mysqli_connect('localhost', 'root', '', 'ebay_ece');

        return mysqli_insert_id($link);
    }
?>