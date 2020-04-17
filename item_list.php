<?php include '_security.php';
    validateCreditentials(); ?>
  
<!DOCTYPE html>
<html>

<head>
    <title>Q5</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5ff10a469d.js" crossorigin="anonymous"></script>
</head>

<?php
  include '_navbar.php';
  include '_item.php';

  $user_type = $_SESSION["user_type"];
  $category = isset($_GET['category']) ? $_GET['category'] : 1; //die('An error occured while loading the category');

  
  function createItemCard($item) {
    $image_path = '/image_database/' . $item->imgs[0];

    echo '<div class="col-md-4">
            <div class="card mb-4 box-shadow">
              <a href="#"><img class="card-img-top stretched-link" src="' . $image_path . '" alt="Card image cap"></a>
              <div class="card-body">
                <h5 class="card-title">' . $item->name . '</h5>
                <h6 class="card-subtitle mb-2 text-primary">' . $item->price . '€</h6>
                <p class="card-text">' . $item->short_desc . '</p>
                <a href="view_item.php?id=' . $item->id . '" class="btn btn-primary d-flex justify-content-center">Consulter</a>
          </div></div></div>';
  }
?>

<body>
    <?php displayNavbar(); ?>

    <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">

          <?php             
            if($category == 1) {
              $sql = 'SELECT * FROM items WHERE categorie = "ferraille/trésor"';
            } else if ($category == 2) {
              $sql = 'SELECT * FROM items WHERE categorie = "musée"';
            } else if($category == 3) {
              $sql = 'SELECT * FROM items WHERE categorie = "vip"';
            }
            
            $result = sql_request($sql);

            while($data = $result->fetch_assoc()) {
              $item = new Item($data);
              createItemCard($item);
            }

          ?>
          </div>
        </div>
      </div>
</body>