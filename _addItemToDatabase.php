<?php 
    function generateRandomFilename() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $filename = '';

        for ($i = 0; $i < 8; $i++) {
            $filename .= $characters[rand(0, $charactersLength - 1)];
        }

        return $filename;
    }

    function uploadImages() {
        $uploads_dir = 'image_database';
        $images_array = array();

        foreach ($_FILES["imgs"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["imgs"]["tmp_name"][$key];
                $name = basename($_FILES["imgs"]["name"][$key]);
                $type = $_FILES["imgs"]["type"][$key];
                $extension = substr($type, strpos($type, '/')+1);
    
                do {
                    
                    $unique_filename = generateRandomFilename() . '.' . $extension;
                    $unique_filepath = $uploads_dir . '/' . $unique_filename;
                }while(file_exists($unique_filepath));

                array_push($images_array, $unique_filename);
    
                move_uploaded_file($tmp_name, $unique_filepath);
            } else {
                die('An error occured while posting this item7');
            }
        }

        return $images_array;
    }
?>

<?php
    include '_mysql.php';

    $title = isset($_POST['title']) ? $_POST['title'] : die('An error occured while posting this item1');
    $short_desc = isset($_POST['short_desc']) ? $_POST['short_desc'] : die('An error occured while posting this item2');
    $long_desc = isset($_POST['long_desc']) ? $_POST['long_desc'] : die('An error occured while posting this item3');
    $price = isset($_POST['price']) ? $_POST['price'] : die('An error occured while posting this item4');
    $min_price = isset($_POST['minprice']) ? $_POST['minprice'] : die('An error occured while posting this item4.5');
    $files = isset($_FILES['imgs']) ? $_FILES['imgs'] : die('An error occured while posting this item5');
    $date = isset($_POST['date']) ? $_POST['date'] : die('An error occured while posting this item5.5');

    $achat_immediat = isset($_POST['achat-immediat']) ? true : false;
    $enchere = isset($_POST['enchere']) ? true : false;
    $proposition = isset($_POST['proposition']) ? true : false;

    $type_vente = array();

    if($achat_immediat) {
        array_push($type_vente, "achat_immediat");
    }
    if($enchere) {
        array_push($type_vente, "enchere");
    }
    if($proposition) {
        array_push($type_vente, "proposition");
    }

    $category =  isset($_POST['category']) ? $_POST['category'] : die('An error occured while posting this item6');

    if($category == 1) {
        $category = 'ferraille/trésor';
    } else if($category == 2) {
        $category = 'musée';
    } else if($category == 3) {
        $category = 'vip';
    } else {
        $category = 'error';
    }

    $images = uploadImages();

    $conn = new mysqli('localhost', 'root', '', 'ebay_ece', '3308');
        
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = 'INSERT INTO `items` (`id`, `nom`, `photos`, `desc_courte`, `desc_longue`, `video`, `categorie`, `prix`, `prix_min`, `type_vente`, `statut`, `echeance`) 
            VALUES (NULL, "' . $title . '", "' . str_replace('"', '\"', serialize($images)) . '", "' . $short_desc . '", "' . $long_desc . '", "' . '", "' . $category . '", "' . $price . '", "' . $min_price . '", "' . str_replace('"', '\"', serialize($type_vente)) . '", "en vente", "' . $date . '")';
    
    $conn->query($sql);

    $data = mysqli_insert_id($conn);

    header('Location: view_item.php?id=' . $data);
?>