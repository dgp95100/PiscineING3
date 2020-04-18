<?php include '_security.php';
    validateCreditentials(); ?>

<?php
  include '_navbar.php';
  include '_item.php';

  $user_type = $_SESSION["user_type"];
  $category = isset($_GET['category']) ? $_GET['category'] : null; //die('An error occured while loading the category');

  
  function createItemCard($item) {
    $image_path = '/image_database/' . $item->imgs[0];

    echo '<div class="card">
            <img src="' . $image_path . '" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">' . $item->name . '</h5>
              <p class="card-text">' . $item->long_desc . '</p>
            </div>
            <div class="card-footer text-center">
            <a href="view_item.php?id=' . $item->id . '">
              <input class="btn btn-primary submit-button" name="button" onclick="checkCreditentials()" value="Voir l\'article">
              </a>
            </div>
        </div>';
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
      background-color: blanchedalmond;
    }

  .card {
    border: none;
    border-radius: 10px;
    background-color: #307782a6;
    margin: 20px 20px;
  }
  .card img {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    height: 50%;
    background-color: white;
  }

  .card-deck {
    padding-bottom: 20%;
  }

  .jumbotron {
    background-color: transparent;
    padding-top: 7%;
    padding-bottom: 7%;
    background: url('index_background.jpg') no-repeat center center/cover fixed;
    margin: 0;
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
  
  .container {
    background-color: transparent;
    margin-top: 3%;
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
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-uppercase section-heading">Catégories</h2>
                    <h3 class="text-muted section-subheading">Lorem ipsum dolor sit amet consectetur</h3>
                </div>
            </div>
            <div class="row text-center">
                  <div class="col-md-4">
                  <a href="item_list.php?category=1">
                    <img src="tresor.gif" width="200px" height="200px">
                    <h4 class="section-heading">Pierres précieuses</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                  </a>
                </div>
                <div class="col-md-4">
                  <a href="item_list.php?category=2">
                    <img src="musée.jpg" width="200px" height="200px">
                    <h4 class="section-heading">Objets de musée</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                  </a>
                </div>
                <div class="col-md-4">
                  <a href="item_list.php?category=3">
                    <img src="vip.jpg" width="200px" height="200px">
                    <h4 class="section-heading">Accessoires VIP</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                  </a>
                </div>
            </div>
        </div>
</body>