<?php include '_security.php';
    validateCreditentials(); ?>

<?php
  include '_navbar.php';
  include '_item.php';

  $user_type = $_SESSION["user_type"];
  $category = isset($_GET['category']) ? $_GET['category'] : null; //die('An error occured while loading the category');

  
  function createItemCard($item) {
    $image_path = '/image_database/' . $item->imgs[0];

    echo '<div class="col-md-4"><div class="card">
            <img src="' . $image_path . '" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">' . $item->name . '</h5>
              <p class="card-text overflow-auto">' . $item->long_desc . '</p>
            </div>
            <div class="card-footer text-center">
            <a href="view_item.php?id=' . $item->id . '">
              <input class="btn btn-primary submit-button" name="button" onclick="checkCreditentials()" value="Voir l\'article">
              </a>
            </div>
        </div></div>';
    }
?>
  
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
<style type="text/css">
  body {
      background: url('index_background.jpg') no-repeat center center fixed;
    }

  .card {
    border: none;
    border-radius: 10px;
    background-color: #307782a6;
    margin: 20px 20px;
    height: 100%;
  }
  .card img {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    background-color: white;
  }

  .card-deck {
    padding-bottom: 20%;
  }

  .card-text {
    max-height: 250px;
  }

  .jumbotron {
    background-color: transparent;
    padding-top: 10%;
    padding-bottom: 10%;
  }

  .col-md-4 {
    margin-bottom: 55px;
  }

    .searchbar{
    margin-bottom: auto;
    margin-top: auto;
    height: 60px;
    background-color: #353b48;
    border-radius: 30px;
    padding: 10px;
    }

    .search_input{
    color: white;
    padding: 0 10px;
    border: 0;
    outline: 0;
    background: none;
    width: 150px;
    caret-color:transparent;
    line-height: 40px;
    transition: width 0.3s cubic-bezier(0.37, -0.38, 1, -0.18);
    }

    .searchbar:hover > .search_input {
    padding: 0 10px;
    width: 450px;
    caret-color:red;
    transition: width 0.3s cubic-bezier(0.37, -0.38, 1, -0.18);
    }

    .searchbar:hover > .search_icon {
    background: white;
    color: #e74c3c;
    }

    .search_icon{
    height: 40px;
    width: 40px;
    float: right;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color:white;
    text-decoration:none;
    }

    
.btn {
            background: linear-gradient(40deg, #ffd86f, #fc6262);
            border-radius: 8px;
            border: none;
            color: blanchedalmond;
            width: 100%;
            display: inline-block;
            font-size: 23px;
            white-space: nowrap;
        }
</style>

<body>
    <?php displayNavbar(); ?>

    <div class="jumbotron jumbotron-fluid">
      <div class="d-flex justify-content-center h-100">
        <div class="searchbar">
            <input class="search_input" type="text" name="" placeholder="Search...">
            <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
          </div>
      </div>
    </div>
      <div class="container">
        <div class="card-deck">
          <?php             
              if($category == 1) {
                $sql = 'SELECT * FROM items WHERE categorie = "ferraille/trésor"';
              } else if ($category == 2) {
                $sql = 'SELECT * FROM items WHERE categorie = "musée"';
              } else if($category == 3) {
                $sql = 'SELECT * FROM items WHERE categorie = "vip"';
              }
              
              $result = sql_request($sql);

              $i=0;

              while($data = $result->fetch_assoc()) {
                if($i%3==0) {
                  echo '<div class="row">';
                }
                $item = new Item($data);
                createItemCard($item);
                if($i%3==2) {
                  echo '</div>';
                }
                $i++;
              }

            ?>
        </div>
      </div>
</body>