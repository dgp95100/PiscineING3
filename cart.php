<?php include '_security.php';
    validateCreditentials(); ?>

<?php
    include '_user.php';
    include '_address.php';
    include '_bankinfos.php';

    $single_item = isset($_GET['single_item']) ? $_GET['single_item'] : null;

    $sql = 'SELECT * FROM comptes WHERE id=' . $_SESSION['user_id'];
    $user = new User(get_sql_object($sql));

    $sql = 'SELECT adresse FROM comptes WHERE id=' . $_SESSION['user_id'];
    $data = get_sql_object($sql);
    $address = new Address($data['adresse']);

    $sql = 'SELECT infos_bancaires FROM comptes WHERE id=' . $_SESSION['user_id'];
    $data = get_sql_object($sql);
    $bankinfos = new BankInfos($data['infos_bancaires']);

    $items = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    $total = 0;

    function drawSingleItem($single_item) {
        global $total;
        $sql = 'SELECT * FROM items WHERE id=' . $single_item;

        $data = get_sql_object($sql);
        $item = new Item($data);

        $imgsrc = 'image_database/' . $item->imgs[0];

        echo '<li class="list-group-item d-flex ">
            <div class="img">
                <img src="' . $imgsrc . '">
            </div>
            <div class="top d-flex justify-content-between">
                <div class="top-content">
                    <h6 class="my-0">' . $item->name . '</h6>
                    <small class="text-muted">' . $item->short_desc . '</small>
                </div>
                <span class="text-muted">' . $item->price . ' €</span>
            </div>
        </li>';

        $total += $item->price;
    }

    function drawItemList($items) {
        global $total;

        if($items == null) {
            echo '<div class="alert alert-danger text-center" role="alert">
                Votre panier est vide ! <br>Veuillez ajouter des éléments avant de continuer.<br>Cliquez pour <a href="categories.php" class="alert-link">parcourir les catétories</a>.
            </div>';
            return;
        }

        for($i = 0; $i < count($items); $i++) {
            $sql = 'SELECT * FROM items WHERE id=' . $items[$i];

            $data = get_sql_object($sql);
            $item = new Item($data);

            $imgsrc = 'image_database/' . $item->imgs[0];

            echo '<li class="list-group-item d-flex ">
                <div class="img">
                    <img src="' . $imgsrc . '">
                </div>
                <div class="top d-flex justify-content-between">
                <button class="btn btn-danger btn-lg btn-block" id="delete" onclick="deleteItem(' . $items[$i] . ')" hidden>Supprimer</button>
                    <div class="top-content">
                        <h6 class="my-0">' . $item->name . '</h6>
                        <small class="text-muted">' . $item->short_desc . '</small>
                    </div>
                    <span class="text-muted">' . $item->price . ' €</span>
                </div>
            </li>';

            $total += $item->price;
        }
    }

    function writeTotal($total) {
        echo $total . " €";
    }

    function showAdressForm($address) {
        echo '<div id="address_div">   
                <h4 class="mb-3">Informations de facturation</h4>
                <form class="custom-form needs-validation" id="user_address-form" action="javascript:void(0)" novalidate>       
                        <div class="form-row form-group" id="lastname_div">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="lastname-input-field">Nom </label></div>
                            <div class="col-sm-8 input-column">
                            <input class="form-control" type="text" name="lastname" value="' . $address->lastname . '" required >
                            <div class="invalid-feedback">Ce champ ne peut pas être vide</div>
                            </div>
                        </div>                          
                        <div class="form-row form-group" id="name_div">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="name-input-field">Prénom </label></div>
                            <div class="col-sm-8 input-column">
                            <input class="form-control" type="text" name="name" value="' . $address->name . '" required>
                            <div class="invalid-feedback name-invalid">Ce champ ne peut pas être vide</div>
                            </div>
                        </div>
                        <div class="form-row form-group" id="address1_div">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="address1-input-field">Adresse ligne 1 </label></div>
                            <div class="col-sm-8 input-column">
                            <input class="form-control" type="text" name="address1" value="' . $address->address1 . '" required >
                            <div class="invalid-feedback">Ce champ ne peut pas être vide</div>
                            </div>
                        </div>
                        <div class="form-row form-group" id="address2_div">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="address2-input-field">Adresse ligne 2 </label></div>
                            <div class="col-sm-8 input-column">
                            <input class="form-control" type="text" name="address2" value="' . $address->address2 . '" >
                            </div>
                        </div>
                        <div class="form-row form-group" id="city_div">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="city-input-field">Ville </label></div>
                            <div class="col-sm-8 input-column">
                            <input class="form-control" type="text" name="city" value="' . $address->city . '" required >
                            <div class="invalid-feedback">Ce champ ne peut pas être vide</div>
                            </div>
                        </div>
                        <div class="form-row form-group" id="postcode_div">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="postcode-input-field">Code postal </label></div>
                            <div class="col-sm-8 input-column">
                            <input class="form-control" type="text" name="postcode" value="' . $address->postcode . '" maxlength="5" required >
                            <div class="invalid-feedback">Ce champ ne peut pas être vide</div>
                            </div>
                        </div>
                        <div class="form-row form-group" id="country_div">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="country-input-field">Pays </label></div>
                            <div class="col-sm-8 input-column">
                            <input class="form-control" type="text" name="country" value="' . $address->country . '" required >
                            <div class="invalid-feedback">Ce champ ne peut pas être vide</div>
                            </div>
                        </div>
                        <div class="form-row form-group" id="phone_div">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="phone-input-field">Téléphone </label></div>
                            <div class="col-sm-8 input-column">
                            <input class="form-control" type="text" name="phone" value="' . $address->phone . '" required >
                            <div class="invalid-feedback">Ce champ ne peut pas être vide</div>
                            </div>
                        </div>
                        <div class="text-center form-row form-group" id="buttons_div">
                            <div class="col-sm-3 label-column"></div>
                            <div class="col-sm-8 input-column">
                                <input class="btn btn-secondary btn-validate submit-button mt-3" onclick="abortFormUpdate(\'user_address\')" name="button" value="Annuler" hidden>
                                <input class="btn btn-primary btn-validate submit-button mt-3" type="submit" name="button" value="Valider" hidden>
                            </div>
                        </div>
                </form>
            </div>';
    }

    function showBankinfosForm($bankinfos) {
        echo '<div id="bank_div" hidden style="opacity: 0%;">        
        <h4 class="mb-3" id="h4banner">Informations de paiement</h4>
        <form class="custom-form needs-validation" id="user_bank-form" action="javascript:void(0)" novalidate>       
                            <div class="form-row form-group" id="cardtype_div">
                                <div class="col-sm-3 label-column"><label class="col-form-label" for="cardtype-input-field">Type de carte </label></div>
                                <div class="col-sm-8 input-column">
                                <input class="form-control" type="text" name="cardtype" value="' . $bankinfos->type . '" required >
                                <div class="invalid-feedback">Ce champ ne peut pas être vide</div>
                                </div>
                            </div>                          
                            <div class="form-row form-group" id="cardname_div">
                                <div class="col-sm-3 label-column"><label class="col-form-label" for="cardname-input-field">Nom affiché sur la carte </label></div>
                                <div class="col-sm-8 input-column">
                                <input class="form-control" type="text" name="cardname" value="' . $bankinfos->name . '" required>
                                <div class="invalid-feedback name-invalid">Ce champ ne peut pas être vide</div>
                                </div>
                            </div>
                            <div class="form-row form-group" id="cardnumber_div">
                                <div class="col-sm-3 label-column"><label class="col-form-label" for="cardnumber-input-field">Numéro de carte </label></div>
                                <div class="col-sm-8 input-column">
                                <input class="form-control" type="text" name="cardnumber" value="' . $bankinfos->number . '" maxlength="19" required >
                                <div class="invalid-feedback">Ce champ ne peut pas être vide</div>
                                </div>
                            </div>
                            <div class="form-row form-group" id="cardexpiration_div">
                                <div class="col-sm-3 label-column"><label class="col-form-label" for="cardexpiration-input-field">Date d\'expiration </label></div>
                                <div class="col-sm-8 input-column">
                                <input class="form-control" type="text" name="cardexpiration" value="' . $bankinfos->expiration . '" maxlength="5" required>
                                <div class="invalid-feedback">Ce champ ne peut pas être vide</div>
                                </div>
                            </div>
                            <div class="form-row form-group" id="cardcode_div">
                                <div class="col-sm-3 label-column"><label class="col-form-label" for="cardcode-input-field">Cryptogramme </label></div>
                                <div class="col-sm-8 input-column">
                                <input class="form-control" type="password" name="cardcode" value="' . $bankinfos->code . '" maxlength="4" required >
                                <div class="invalid-feedback">Ce champ ne peut pas être vide</div>
                                </div>
                            </div>
                            <div class="text-center form-row form-group" id="buttons_div">
                                <div class="col-sm-3 label-column"></div>
                                <div class="col-sm-8 input-column">
                                    <input class="btn btn-secondary btn-validate submit-button mt-3" onclick="abortFormUpdate(\'user_bank\')" name="button" value="Annuler" hidden>
                                    <input class="btn btn-primary btn-validate submit-button mt-3" type="submit" name="button" value="Valider" hidden>
                                </div>
                            </div>
                    </form>
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
    <script>
        let singleitem = <?php echo ($single_item == null) ? "false" : $single_item; ?>

        window.addEventListener('load', function() {
            $('#bank_div')[0].style.height = $('#address_div')[0].offsetHeight + 'px'

            $('#continue').click(function() {

                $('#continue').animate({
                    opacity: 0
                }, 250, function() {
                    $('#secondpagebuttons')[0].hidden = false;

                    $('#secondpagebuttons').animate({
                        opacity: 1
                    }, 250)
                })

                $('#address_div').animate({
                    opacity: 0
                }, 250, function() {
                    $('#address_div')[0].hidden = true;
                    $('#bank_div')[0].hidden = false;
                    $('#user_bank-form')[0].style.paddingTop = ($('#bank_div')[0].offsetHeight - $('#user_bank-form')[0].offsetHeight)/2 - $('#h4banner')[0].offsetHeight + 'px'

                    $('#bank_div').animate({
                        opacity: 1
                    }, 250)
                })
            })

            $('#back').click(function() {

                $('#secondpagebuttons').animate({
                    opacity: 0
                }, 250, function() {
                    $('#continue')[0].hidden = false;

                    $('#continue').animate({
                        opacity: 1
                    }, 250)
                })

                $('#bank_div').animate({
                    opacity: 0
                }, 250, function() {
                    $('#bank_div')[0].hidden = true;
                    $('#address_div')[0].hidden = false;
                    //$('#user_address-form')[0].style.paddingTop = ($('#bank_div')[0].offsetHeight - $('#user_bank-form')[0].offsetHeight)/2 - $('#h4banner')[0].offsetHeight + 'px'

                    $('#address_div').animate({
                        opacity: 1
                    }, 250)
                })
            })
            
            if(singleitem == false) {
                $('.list-group-item').hover(function() {
                    $(this).find('.top-content')[0].hidden = true;
                    $(this).find('span')[0].hidden = true;
                    $(this).find('#delete')[0].hidden = false;
                }, function() {
                    $(this).find('.top-content')[0].hidden = false;
                    $(this).find('span')[0].hidden = false;
                    $(this).find('#delete')[0].hidden = true;
                })
            }
        })

        function validatePayment() {
            $.ajax({ url: '_makePayment.php', 
                data: {singleitem: singleitem},
                type: 'post',
                success: function(output) {
                console.log(output)
                if(output == "true") {
                    paymentAccepted();
                }
                else {
                    paymentRefused(output);
                }
            }});
        }

        function paymentAccepted() {
            $('.modal-title')[0].innerHTML = "Paiement accepté !";
            $('.modal-body')[0].innerHTML = "Votre achat a bien été validé ! Cliquez sur continuer pour être redirigé vers l'accueil";
            //$('.modal')[0].setAttribute('data-backdrop', 'static');
            $('#modal_cancel_btn')[0].hidden = true;
            $('#modal_accept_btn')[0].hidden = true;
            $('#modal_escape_btn')[0].hidden = true;
            $('#modal_continue_btn')[0].hidden = false;
        }

        function paymentRefused(missing) {
            $('.modal-title')[0].innerHTML = "Paiement refusé";
            $('.modal-body')[0].innerHTML = "Une erreur est survenue lors de la validation du paiement.<br>Il vous manque " + missing + "€ sur le solde de votre compte.<br>Veuillez <a href=\"account.php\">ajouter des fonds</a>.";

            $('#modal_cancel_btn')[0].hidden = true;
            $('#modal_accept_btn')[0].hidden = true;
            $('#modal_ok_btn')[0].hidden = false;
        }

        function deleteItem(id) {
            $.ajax({ url: '_removeFromCart.php', data: {id: id},
                type: 'post',
                success: function(output) {
                    console.log(output)

                    if(output === "true") {
                        document.location.reload(true)
                    }
            }});
        }

    </script>
    
    <style>
        .btnvalidate {
            background: linear-gradient(40deg, #1e9999, #00ff2c);
            border-radius: 8px;
            border: none;
            color: blanchedalmond;
            display: inline-block;
            font-size: 23px;
            white-space: nowrap;
        }

        .btnpromo {
            background: linear-gradient(40deg, #1e9999, #00ff2c);
            border-radius: 8px;
            border: none;
            color: blanchedalmond;
            display: inline-block;
            white-space: nowrap;
        }
  
        body {
            background: url('index_background.jpg') no-repeat center center/cover fixed;
            background-size: cover;
        }

        .container {
            background-color: rgba(255,255,255,0.7);
            margin-top: 5%;
            margin-bottom: 5%;
            padding-bottom: 2%;
            padding-left: 2%;
            padding-right: 2%;
            border-radius: 30px;
        }

        .list-group {
            align-self: center;
            width: 100%;
            max-height: 420px;
        }

        .list-group-item {
            height: 20%;
            padding: 0;
            border: none;
        }

        img {
            max-height: 150px;
            width: auto;
            max-width: 150px;
        }

        .top {
            padding: 1.5rem 1.5rem;
            width: 100%;
            align-items: center;
        }

        .scrollable {
            overflow: auto;
        }

        .total {
            background-color: white;
            height: 50px;
            align-items: center;
            padding-right:5%;
        }  
      
    </style>
  </head>

<body class="bg-light">
<?php include '_navbar.php';
        displayNavbar();
    ?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>
                <?php if($single_item == null) {
                            echo 'Mon panier';
                        } else {
                            echo 'Achat direct';
                        } ?>
            </h2>
            <p class="lead">
                <?php if($single_item == null) {
                    echo 'Veuillez remplir le formulaire de facturation ci-dessous afin de procéder à l\'achat de ces objets.';
                } else {
                    echo 'Veuillez remplir le formulaire de facturation ci-dessous afin de procéder à l\'achat de cet objet.';
                }
                echo ' Vous pourrez à tout moment modifier vos informations dans votre profil dans la séction "Informations bancaires et de facturation".';
                ?>
            </p>
        </div>

        <div class="row">
            <div class="col-md-6 order-md-2 d-flex flex-column justify-content-between">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Panier</span>
                        <span class="badge badge-secondary badge-pill"><?php echo ($single_item == null ? count($items) : 1)?></span>
                    </h4>
                <div>
                    <ul class="list-group overflow-auto">
                        <?php 
                        if($single_item == null) {
                            drawItemList($items);
                        }
                        else {
                            drawSingleItem($single_item);
                        } ?>

                    </ul>
                </div>

                <div class="">
                    <div class="total d-flex justify-content-end">
                        <div>
                        <span>Total (EUR): </span>
                        <strong><?php writeTotal($total) ?></strong></div>
                    </div>
                    <form class=".card.p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Code promo">
                            <div class="input-group-append">
                                <button type="submit" class="btn btnpromo btn-secondary">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 c2">
                <?php showAdressForm($address);
                showBankinfosForm($bankinfos);?>
                <div id="">
                    <div id="firstpagebuttons">
                        <button class="btn btn-primary btnvalidate btn-lg btn-block" type="submit" id="continue">Continuer</button>
                    </div>
                    <div class="row" id="secondpagebuttons" hidden>
                        <div class="col-md-6">
                        <button class="btn btn-secondary btnvalidate btn-lg btn-block" type="submit" id="back">Revenir</button></div>
                        <div class="col-md-6">
                        <button class="btn btn-primary btnvalidate btn-lg btn-block" type="submit" id="finish" data-toggle="modal" data-target="#confirmationModal">Finaliser l'achat</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation de paiement</h5>
        <button type="button" class="close" data-dismiss="modal" id="modal_escape_btn">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Etes-vous sûr de vouloir finaliser cet achat ? <?php echo $total ?>€ seront débités de votre compte.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal_cancel_btn">Annuler</button>
        <button type="button" class="btn btn-primary" onclick="validatePayment()" id="modal_accept_btn">Accepter</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal_ok_btn" hidden>OK</button>
        <a href="index.php" id="modal_continue_btn" hidden><button type="button" class="btn btn-primary" >Continuer</button></a>
      </div>
    </div>
  </div>
</div>
</body>