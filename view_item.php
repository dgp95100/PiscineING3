<?php include '_security.php';
    validateCreditentials(); ?>

<?php
    include '_navbar.php';
    include '_item.php';

    $user_type = $_SESSION['user_type'];

    $item_id = isset($_GET['id']) ? $_GET['id'] : die('An error occured while loading the item');


    $sql = 'SELECT * FROM items WHERE id=' . $item_id;
    $result = sql_request($sql);
    $item_data = $result->fetch_assoc();

    $item = new Item($item_data);

    function createCarouselIndicators($item) {
        for ($i = 0; $i < count($item->imgs); $i++) {
            echo '<li data-target="#carousel" data-slide-to="' . $i . '"' . ($i == 0 ? ' class="active"' : '') . '></li>';
        }
    }

    function createCarouselItems($item) {
        for ($i = 0; $i < count($item->imgs); $i++) {
            $img_src = '/image_database/' . $item->imgs[$i];
            echo '<div class="carousel-item ' . ($i == 0 ? "active" : "") . '">
                    <img class="d-block" src="' . $img_src . '" alt="First slide">
                  </div>';
        }
    }

    function displayButtons($item) {
        $achat_immediat = in_array('achat_immediat', $item->sell_type);
        $enchere = in_array('enchere', $item->sell_type);
        $meilleure_offre = in_array('proposition', $item->sell_type);

        if($achat_immediat) {
            displayBuyButton($item);
        }

        if($meilleure_offre) {
            displayOfferButton($item);
        } else if($enchere) {
            displayBidButton($item);
        }

        if($_SESSION['user_type'] == 'Admin') {
            displayDeleteButton($item);
        }
    }

    function displayBuyButton($item) {

        if($_SESSION['user_type'] == "Acheteur") {
            echo '<div class=button-row><h1 class="text-primary text-right">' . $item->price . '€</h1>';
            echo '<a href="#"><button type="button" class="btn btn-custom btn-secondary btn-lg btn-block" onclick="addToCart(' . $item->id . ')">Ajouter au panier</button></a>';
            echo '<a href="#"><button type="button" class="btn btn-custom btn-primary btn-lg btn-block" onclick="addToCart(' . $item->id . ')">Acheter maintenant</button></a></div>';
        } else {
            echo '<div class=button-row><div class="row price-row"><h5 class="mt-3">Achat immédiat:</h5><h1 class="text-primary text-right">' . $item->price . '€</h1></div>';
        }
    }

    function displayBidButton($item) {
        $bid_infos = getBidInfos($item);

        $now = new DateTime();
        $future_date = new DateTime($item->end_time . ' 00:00:00');
        $interval = $future_date->diff($now);

        $remaining_time = $interval->format("%a jours, %h heures, %i minutes");

        echo '<div class=button-row><div class="row price-row">';
        echo '<h5 class="mt-3">Enchère la plus élevée:</h5><h1 class="text-secondary text-right">' . $bid_infos['display_price'] . '€</h1></div></div>';
        
        if($_SESSION['user_type'] == "Acheteur") {
            if ($bid_infos['already_highest_bid']) {
                echo '<a href="#"><button type="button" class="btn btn-custom btn-secondary btn-lg btn-block">Vous détenez la plus grosse enchère</button></a>';
            }
            else {
                echo '<a href="#"><button type="button" data-toggle="modal" data-target="#bidModal" class="btn btn-custom btn-success btn-lg btn-block">Enchérir</button></a>';
            }
        }

        echo '<div class="row price-row justify-content-center"><h5 class="text-center">L\'enchère se finit dans:</h5><h4 class="text-primary text-right">' . $remaining_time . '</h4></div></div>';
    }

    function displayOfferButton($item) {
        if($_SESSION['user_type'] == "Acheteur") {
            if (hasUserMadeProposition($item)) {
                echo '<a href="#"><button type="button" class="btn btn-secondary btn-lg btn-block">Vous avez déjà proposé une offre</button></a>';
            }
            else {
                echo '<a href="#"><button type="button" data-toggle="modal" data-target="#propositionModal" class="btn btn-success btn-lg btn-block">Faire une offre</button></a>';
            }
        }
    }

    function displayDeleteButton($item) {
        echo '<br><br><div class=button-row><a href="#"><button type="button" class="btn btn-danger btn-lg btn-block" onclick="deleteItem()">Supprimer l\'item</button></a></div>';
    }

    function getBidInfos($item) {
        $alreadyHighestBid = false;
        $highest_bid = $item->min_price;

        $sql = 'SELECT * FROM transactions WHERE item=' . $item->id . ' AND type="enchere"';
        $result = sql_request($sql);
        
        while($data = $result->fetch_assoc()) {
            if ($data['prix'] > $highest_bid) {
                $highest_bid = $data['prix'];

                if($data['acheteur'] == $_SESSION['user_id']) {
                    $alreadyHighestBid = true;
                } else {
                    $alreadyHighestBid = false;
                }
            }
        }

        return array('display_price' => $highest_bid, 'already_highest_bid' => $alreadyHighestBid);
    }

    function hasUserMadeProposition($item) {
        $sql = 'SELECT * FROM transactions WHERE item=' . $item->id . ' AND type="proposition"';

        $result = sql_request($sql);
        
        while($data = $result->fetch_assoc()) {
            if($data['acheteur'] == $_SESSION['user_id']) {
                return true;
            }
        }

        return false;
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
    <style type="text/css"> 
    .btn-custom {
        margin-bottom: 30px;
    }

    .row {
        margin: 20px;
    }

    .button-row {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .price-row {
        margin: 0;
        justify-content: space-between;
        align-items: center;
    }
    .carousel-inner > .carousel-item > img {
        width: auto;
        height:450px;
        max-height:450px;
        margin: 0 auto;
    }

    .btn {
        font-size: 25px;
        border-radius: 5px;
        border: none;
        color: blanchedalmond;
    }

    .btn-danger {
        background: linear-gradient(40deg, #92235b, #ff0000);  
    }

    .btn-primary {
        background: linear-gradient(40deg, #1e9999, #00ff2c);
    }

    .btn-success {
        background: linear-gradient(40deg, #0848ff, #00e7ff);
    }

    .btn-secondary {
        background: linear-gradient(40deg, #7dafad, #0053eb);
    }

    h1 {
        color: black!important;
    }
    .text-secondary {
        color: blanchedalmond!important;
    }
    
    </style>
    <script>
      // Source from: https://getbootstrap.com/docs/4.4/components/forms/#validation
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              else {
                  if(form.id === 'bid-form') {
                    makeBid();
                  }
                  else if(form.id === 'proposition-form') {
                    makeProposition();
                  }
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
    <script>
        function addToCart(item_id) {
            $.ajax({url: '_addToCart.php',
                    data: {id: item_id},
                    type: 'post',
                    success: function(output) {
                        console.log(output);
                    if(output == "already in array") {
                        alert('Cet item est déjà présent dans votre panier');
                    }
                    else {
                        window.location = "view_item.php?id=<?php echo $item->id; ?>";
                    }
                    }});
        }

        function makeBid() {
            $.ajax({url: '_makeBid.php',
                    data: {id: <?php echo $item->id; ?>,
                           price: document.getElementById('bid-price').value},
                    type: 'post',
                    success: function(output) {
                        console.log(output);
                    }});
        }

        function makeProposition() {
            $.ajax({url: '_makeProposition.php',
                    data: {id: <?php echo $item->id; ?>,
                           price: document.getElementById('proposition-price').value},
                    type: 'post',
                    success: function(output) {
                        console.log(output);
                    }});
        }

        function deleteItem() {
            $.ajax({url: '_deleteItem.php',
                    data: {id: <?php echo $item->id; ?>},
                    type: 'post',
                    success: function(output) {
                        if(output == "true") {
                            alert("Cet annonce a bien été supprimée");
                            window.location="index.php#services";
                        }
                    }});
        }
    </script>
</head>
<body style="background-image: url('background-blur.jpg');">
    <?php displayNavbar(); ?>  

        <div id="carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                 <?php createCarouselIndicators($item); ?>
            </ol>
            <div class="carousel-inner" style="background-color:darkgrey;">
                <?php createCarouselItems($item); ?>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container">

        <div class="row">
            <div class="col-md-8">
                <h1><?php echo $item->name; ?></h1>
                <h3 class="text-secondary"><?php echo $item->short_desc; ?></h3>
                <p><?php echo $item->long_desc; ?></p>
            </div>
            <div class="col-md-4">
                <?php
                    displayButtons($item);
                ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bidModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enchérir</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="bid-form" method="post" action="view_item.php?id=<?php echo $item->id; ?>" novalidate>
                        <div class="form-group">
                            <label for="price" class="col-form-label">Veuillez indiquer votre prix:</label>
                            <input type="number" class="form-control" id="bid-price" min="<?php echo getBidInfos($item)['display_price']+1; ?>" required>
                            <div class="invalid-feedback">Vous devez saisir un prix supérieur à <?php echo getBidInfos($item)['display_price']; ?>€</div>
                        </div>
                        <div class="form-check">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="propositionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enchérir</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="proposition-form" method="post" action="view_item.php?id=<?php echo $item->id; ?>" novalidate>
                        <div class="form-group">
                            <label for="price" class="col-form-label">Veuillez indiquer le prix de votre offre:</label>
                            <input type="number" class="form-control" id="proposition-price" required>
                            <div class="invalid-feedback">Vous devez renseigner ce champ</div>
                        </div>
                        <div class="form-check">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>