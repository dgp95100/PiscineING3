<?php include '_security.php';
    validateCreditentials(); ?>

<?php
    include '_user.php';
    include '_address.php';
    include '_bankinfos.php';

    $addfunds = isset($_GET['funds_added']) ? $_GET['funds_added'] : null;

    $sql = 'SELECT * FROM comptes WHERE id=' . $_SESSION['user_id'];
    $user = new User(get_sql_object($sql));

    $sql = 'SELECT adresse FROM comptes WHERE id=' . $_SESSION['user_id'];
    $data = get_sql_object($sql);
    $address = new Address($data['adresse']);

    $sql = 'SELECT infos_bancaires FROM comptes WHERE id=' . $_SESSION['user_id'];
    $data = get_sql_object($sql);
    $bankinfos = new BankInfos($data['infos_bancaires']);

    function showUserInfos($user) {
        echo '<div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Mes informations personnelles
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="text-right" onclick="unlockFieldSet(\'user_info-fieldset\')">
                                    <i class="fas fa-edit" style="cursor: pointer"></i>
                                </div>
                                <form class="custom-form needs-validation" name="user_info-form" action="javascript:void(0)" novalidate>       
                                    <fieldset id="user_info-fieldset" disabled>                            
                                        <div class="form-row form-group" id="pseudo_div">
                                            <div class="col-sm-3 label-column"><label class="col-form-label" for="pseudo-input-field">Pseudo </label></div>
                                            <div class="col-sm-8 input-column">
                                            <input class="form-control" type="text" name="pseudo" oninput="checkIfUsernameIsAlreadyTaken(this)" value="' . $user->pseudo . '" required >
                                            <div class="invalid-feedback pseudo-invalid">Ce champ est obligatoire</div>
                                            </div>
                                        </div>
                                        <div class="form-row form-group" id="mail_div">
                                            <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">Email </label></div>
                                            <div class="col-sm-8 input-column">
                                            <input class="form-control" type="email" name="mail" value="' . $user->mail . '" required >
                                            <div class="invalid-feedback">Ce champ est obligatoire</div>
                                            </div>
                                        </div>
                                        <div class="form-row form-group" id="password_div">
                                            <div class="col-sm-3 label-column"><label class="col-form-label" for="password-input-field">Mot de passe </label></div>
                                            <div class="col-sm-8 input-column">
                                            <input class="form-control" type="password" name="password" oninput="checkPasswordMatch(this)" value="' . $user->password . '" required >
                                            <div class="invalid-feedback">Ce champ est obligatoire</div>
                                            </div>
                                        </div>
                                        <div class="form-row form-group" id="password_confirmation_div" hidden>
                                            <div class="col-sm-3 label-column"><label class="col-form-label" for="repeat-pawssword-input-field">Confirmation </label></div>
                                            <div class="col-sm-8 input-column">
                                            <input class="form-control" type="password" name="password_confirmation" oninput="checkPasswordMatch(this)" value="' . $user->password . '" required>
                                            <div class="invalid-feedback">Les mots de passe ne correspondent pas</div>
                                            </div>
                                        </div>
                                        <div class="form-row form-group" id="insc-date_div">
                                            <div class="col-sm-3 label-column"><label class="col-form-label" for="insc-date-input-field">Date d\'inscription </label></div>
                                            <div class="col-sm-8 input-column">
                                            <input class="form-control" type="text" name="insc-date" value="' . $user->inscription . '" required disabled>
                                            </div>
                                        </div>
                                        <div class="form-row form-group" id="type_div">
                                            <div class="col-sm-3 label-column"><label class="col-form-label" for="type-input-field">Type de compte </label></div>
                                            <div class="col-sm-8 input-column">
                                            <input class="form-control" type="text" name="type" value="' . $user->type . '" required disabled>
                                            </div>
                                        </div>
                                        <div class="text-center form-row form-group" id="buttons_div">
                                            <div class="col-sm-3 label-column"></div>
                                            <div class="col-sm-8 input-column">
                                                <input class="btn btn-secondary btn-validate submit-button mt-3" onclick="abortFormUpdate(\'user_info\')" name="button" value="Annuler" hidden>
                                                <input class="btn btn-primary btn-validate submit-button mt-3" type="submit" name="button" value="Valider" hidden>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>                            
                            </div>
                        </div>
                    </div>';
    }

    function showUserAddress($address) {
        echo '<div class="card">
        <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
            <button class="btn btn-link collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Mes informations de facturation
            </button>
        </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <div class="text-right" onclick="unlockFieldSet(\'user_address-fieldset\')">
                    <i class="fas fa-edit" style="cursor: pointer"></i>
                </div>
                <form class="custom-form needs-validation" name="user_address-form" action="javascript:void(0)" novalidate>       
                    <fieldset id="user_address-fieldset" disabled>  
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
                    </fieldset>
                </form>                        
            </div>
        </div>
    </div>';
    }

    function showUserBankinfos($bankinfos) {
        echo '<div class="card">
        <div class="card-header" id="headingThree">
        <h2 class="mb-0">
            <button class="btn btn-link collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Mes informations bancaires
            </button>
        </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                <div class="text-right" onclick="unlockFieldSet(\'user_bank-fieldset\')">
                    <i class="fas fa-edit" style="cursor: pointer"></i>
                </div>
                <form class="custom-form needs-validation" name="user_bank-form" action="javascript:void(0)" novalidate>       
                    <fieldset id="user_bank-fieldset" disabled>  
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
                    </fieldset>
                </form>
            </div>
        </div>
    </div>';
    }

    function showMyItems($user) {
        if($_SESSION['user_type'] != "Admin") {
            echo '<div class="d-flex align-items-center justify-content-between my-3">
                    <h5 class="mb-0">Objets ' . ($user->type == "Acheteur" ?  "achetés" : "vendus") . '</h5>
                </div>
                <div class="row overflow d-flex flex-nowrap" style="height:370px">';

                if($user->type == "Vendeur") {
                    $sql = 'SELECT * FROM items WHERE vendeur=' . $user->id;
                    $result = sql_request($sql);

                    $items = array();

                    while($data = $result->fetch_assoc()) {
                        array_push($items, $data['id']);
                    }
                } else {
                    $items = $user->items;
                }

                for($i=0; $i < count($items); $i++) {
                    $sql = 'SELECT * FROM items WHERE id=' . $items[$i];
                    $item = new Item(get_sql_object($sql));

                    echo '<div class="col-lg-6 mb-2 img-container" style="border-radius: 10px">
                            <a href="view_item.php?id=' . $item->id . '">
                            <img src="image_database/' . $item->imgs[0] . '" alt="" class="img-fluid shadow-sm" style="border-radius: 10px">
                            <h4 class="item_title text-decoration-none">' . $item->name . '</h4>
                            <h3 class="item_price">' . $item->price . ' €</h3>
                            <button class="btn btn-primary btn-lg view-item-btn" style="position: absolute">Accéder à l\'objet</button>
                            </a>
                        </div>';
                }

                echo '</div>';
        } else {
            showVendorList();
        }
    }

    function showTransactionInfos($user) {
        if($_SESSION['user_type'] != "Admin") {
            echo '<div class="bg-light p-4 d-flex justify-content-end text-center">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <h5 class="font-weight-bold mb-0 d-block">' . ($user->items == '' ? 0 : count($user->items)) . '</h5><small class="text-muted">Objets achetés</small>
                </li>
                <li class="list-inline-item">
                    <h5 class="font-weight-bold mb-0 d-block">' . $user->balance . '€</h5><small class="text-muted">Solde</small>
                </li>
            </ul>
            </div>';
            
            if($_SESSION['user_type'] == "Acheteur") {
                echo '<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addFundModal">Ajouter des fonds</button>';
            }
        } else {
            echo '<br><br><br>';
        }
    }

    function showVendorList() {
        $sql = 'SELECT * FROM comptes WHERE type="Vendeur"';
        $result = sql_request($sql);

        echo '<div class="d-flex align-items-center justify-content-between my-3">
                    <h5 class="mb-0" id="vendor" >Liste des vendeurs</h5>
            </div>
            <ul class="list-group">';

        while($data = $result->fetch_assoc()) {
            $seller = new User($data);

            $sql = 'SELECT COUNT(*) FROM items WHERE vendeur=' . $seller->id;
            $item_nb = get_sql_object($sql)['COUNT(*)'];

            echo '<li class="list-group-item d-flex align-items-center">
                    <img src="https://d19m59y37dris4.cloudfront.net/university/1-1-1/img/teacher-4.jpg" width="100px" height="100px">
                    <div class="col-md-6 d-flex flex-column">
                        <h3 class="ml-3 mt-2 mb-0"> ' . $seller->pseudo . ' </h3>
                        <h5 class="ml-3 mb-0 font-weight-normal"> Membre depuis le ' . $seller->inscription . ' </h5>
                        <h5 class="ml-3 mb-0 font-weight-light"> ' . $item_nb . ' items vendus<h5>
                    </div>
                    <button class="btn btn-danger btn-lg btn-block h-50" data-toggle="modal" data-target="#deleteVendorModal" data-seller_id="' . $seller->id . '" data-seller="' . $seller->pseudo . '">Supprimer</button>
                  </li>';
        }
             echo '</ul>';
    }

    function showVendorPropositions() {
        echo '<div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                    <button class="btn btn-link collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Mes propositions d\'offre
                    </button>
                    </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body p-0">';

        echo '<ul class="list-group">';

        $sql = 'SELECT * FROM `transactions` WHERE `transactions`.`item` IN (SELECT id FROM items WHERE items.vendeur = ' . $_SESSION['user_id'] . ') 
                                                    AND transactions.type = "proposition" 
                                                    AND transactions.n_proposition!="-1"';
        $result = sql_request($sql);

        if($result != null) {
            if($result->num_rows == 0) {
                echo '<div class="alert alert-danger m-0 text-center" role="alert" style="height:100px; padding-top: 35px;">';
                echo 'Vous n\'avez actuellement aucune proposition d\'offre';
            }
            while($prop = $result->fetch_assoc()) {
                $sql = 'SELECT * FROM items WHERE id=' . $prop['item'];
                $item = new Item(get_sql_object($sql));

                $sql = 'SELECT * FROM comptes WHERE id=' . $prop['acheteur'];
                $buyer = new User(get_sql_object($sql));

                echo '<li>
                        <div class="list-group-item d-flex align-items-center justify-content-left">
                            <img src="image_database/' . $item->imgs[0] . '" width="auto" height="175px">
                            <div class="col-md-7 d-flex flex-column">
                                <h3 class="ml-3 mt-2 mb-5">' . $item->name . '</h3>';

                if($prop['n_proposition'] == -2) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo 'L\'acheteur <strong>' . $buyer->pseudo . '</strong> a refusé votre offre</div>';
                }
                else if($item->status == 'vendu') {
                    echo '<div class="alert alert-success" role="alert">';
                    echo 'L\'acheteur <strong>' . $buyer->pseudo . '</strong> a accepté votre offre</div>';
                } else {
                    echo'   <h5 class="ml-3 mb-0 font-weight-normal"> Offre proposée par <strong>' . $buyer->pseudo . '</strong></h5>
                            <h5 class="ml-3 mb-0 font-weight-light">Membre depuis le ' . $buyer->inscription . '<h5>';
                            
                }

                echo '</div>
                <div class="col-md-2 justify-self-right text-right">
                <h1>' . $prop['prix'] . '€</h1>
                </div>
                </div>
                <div class="d-flex mx-3">';

                if($item->status == 'vendu' || $prop['n_proposition'] == -2) {
                    echo '<button class="btn btn-danger btn-lg btn-block h-50 m-1" onclick="deleteOffer(' . $prop["id"] . ')">Supprimer</button>';
                } else if($prop['n_proposition']%2 == 0) {
                    echo '<button class="btn btn-primary btn-lg btn-block h-50 m-1" onclick="acceptOffer(' . $buyer->id . ', ' . $_SESSION["user_id"] . ', ' . $prop["item"] . ', ' . $prop["prix"] . ')">Accepter</button>';
                    
                    if($prop['n_proposition'] < 4) {
                        echo '<button class="btn btn-secondary btn-lg btn-block h-50 m-1" data-offer="' . $prop["id"] . '" data-toggle="modal" data-target="#propositionModal">Contre-offre</button>';
                    }

                    echo '<button class="btn btn-danger btn-lg btn-block h-50 m-1" onclick="refuseOffer(' . $prop["id"] . ', -1)">Refuser</button>';
                } else {
                    echo '<button class="btn btn-primary btn-lg btn-block h-50 m-1" disabled>En attente de réponse</button>';
                }
                
                echo '</div></li>';
            }
        }

        echo '</ul></div></div></div>';
    }

    function showBuyerPropositions() {
        echo '<div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                    <button class="btn btn-link collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Mes propositions d\'offre
                    </button>
                    </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body p-0">';

        echo '<ul class="list-group">';

        $sql = 'SELECT * FROM `transactions` WHERE `transactions`.`acheteur` = ' .  $_SESSION['user_id'] .
                                                   ' AND transactions.type = "proposition" 
                                                     AND transactions.n_proposition!="-2"';
        $result = sql_request($sql);

        if($result != null) {
            if($result->num_rows == 0) {
                echo '<div class="alert alert-danger m-0 text-center" role="alert" style="height:100px; padding-top: 35px;">';
                echo 'Vous n\'avez actuellement aucune proposition d\'offre';
            }
            while($prop = $result->fetch_assoc()) {
                $sql = 'SELECT * FROM items WHERE id=' . $prop['item'];
                $item = new Item(get_sql_object($sql));

                if($item->status == 'vendu') {
                    continue;
                }

                $sql = 'SELECT * FROM comptes WHERE id=' . $item->seller;
                $seller = new User(get_sql_object($sql));

                echo '<li>
                        <div class="list-group-item d-flex align-items-center justify-content-left">
                            <img src="image_database/' . $item->imgs[0] . '" width="auto" height="175px">
                            <div class="col-md-7 d-flex flex-column">
                                <h3 class="ml-3 mt-2 mb-5">' . $item->name . '</h3>';
                
                if($prop['n_proposition'] == -1) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo 'Le vendeur <strong>' . $seller->pseudo . '</strong> a refusé votre offre</div>';
                }
                else if($prop['n_proposition'] == 4) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo 'Le vendeur <strong>' . $seller->pseudo . '</strong> a accepté votre offre</div>';
                } else {
                    echo '<h5 class="ml-3 mb-0 font-weight-normal"><strong>' . $seller->pseudo . '</strong> a répondu à votre offre</h5>
                                <h5 class="ml-3 mb-0 font-weight-light">Membre depuis le ' . $seller->inscription . '<h5>';
                }
                
                    echo '</div>
                            <div class="col-md-2 justify-self-right text-right">
                            <h1>' . $prop['prix'] . '€</h1>
                            </div>
                        </div>
                        <div class="d-flex mx-3">';
                
                if($prop['n_proposition'] == -1 ||$prop['n_proposition'] == 4 ) {
                    echo '<button class="btn btn-danger btn-lg btn-block h-50 m-1" onclick="deleteOffer(' . $prop["id"] . ')">Supprimer</button>';
                }
                else if($prop['n_proposition']%2 == 1) {

                    echo '<button class="btn btn-primary btn-lg btn-block h-50 m-1" onclick="acceptOffer(' . $_SESSION["user_id"] . ', ' . $seller->id . ', ' . $prop["item"] . ', ' . $prop["prix"] . ')">Accepter</button>';
                    echo '<button class="btn btn-secondary btn-lg btn-block h-50 m-1" data-offer="' . $prop["id"] . '" data-toggle="modal" data-target="#propositionModal">Contre-offre</button>';
                    echo '<button class="btn btn-danger btn-lg btn-block h-50 m-1" onclick="refuseOffer(' . $prop["id"] . ', -2)">Refuser</button>';
                } else {
                    echo '<button class="btn btn-primary btn-lg btn-block h-50 m-1" disabled>En attente de réponse</button>';
                }
                
                echo '</div></li>';
            }
        }

        echo '</ul></div></div></div>';
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
        function checkIfUsernameIsAlreadyTaken(element) { 
            if(element.value === "<?php echo $user->pseudo ?>") {
                return
            }     

            $.ajax({ url: '_isUsernameAlreadyTaken.php',
                data: {name: element.value},
                type: 'post',
                success: function(output) {
                console.log(output)
                if(output == "true") {
                    document.getElementsByName("pseudo")[0].setCustomValidity('Username already taken');
                    document.getElementsByClassName('pseudo-invalid')[0].innerText = "Ce pseudo est déjà pris";
                }
                else {
                    document.getElementsByName("pseudo")[0].setCustomValidity('');
                }
            }});
        }

        function checkPasswordMatch() {
            if (document.getElementsByName("password_confirmation")[0].value != document.getElementsByName("password")[0].value) {
            document.getElementsByName("password_confirmation")[0].setCustomValidity('Password Must be Matching.');
            } else {
                document.getElementsByName("password_confirmation")[0].setCustomValidity('');
            }
        }

        function lockFieldSet(fieldset_name) {
            let fieldset = document.getElementById(fieldset_name)
            
            fieldset.disabled = true;
            
            let buttons = fieldset.getElementsByClassName('btn-validate')
            for(let i = 0; i < buttons.length; i++) {
                buttons[i].hidden = true;
            }

            if(fieldset_name === 'user_info') {
                $('#' + fieldset_name + ' #password_confirmation_div')[0].hidden = true;
            }
        }

        function unlockFieldSet(fieldset_name) {
            let fieldset = document.getElementById(fieldset_name)

            fieldset.disabled = false;

            let buttons = fieldset.getElementsByClassName('btn-validate')
            for(let i = 0; i < buttons.length; i++) {
                buttons[i].hidden = false;
            }
            
            if(fieldset_name === 'user_info') {
                checkPasswordMatch();
                $('#' + fieldset_name + ' #password_confirmation_div')[0].hidden = false;
            }
        }

        function abortFormUpdate(name) {
            if(name === 'user_info') {
                document.getElementsByName("pseudo")[0].value = '<?php echo $user->pseudo; ?>'
                document.getElementsByName("mail")[0].value = '<?php echo $user->mail; ?>'
                document.getElementsByName("password")[0].value = '<?php echo $user->password; ?>'

                lockFieldSet('user_info-fieldset')
            } else if(name === "user_address") {
                document.getElementsByName("name")[0].value = '<?php echo $address->name; ?>'
                document.getElementsByName("lastname")[0].value = '<?php echo $address->lastname; ?>'
                document.getElementsByName("address1")[0].value = '<?php echo $address->address1; ?>'
                document.getElementsByName("address2")[0].value = '<?php echo $address->address2; ?>'
                document.getElementsByName("city")[0].value = '<?php echo $address->city; ?>'
                document.getElementsByName("postcode")[0].value = '<?php echo $address->postcode; ?>'
                document.getElementsByName("country")[0].value = '<?php echo $address->country; ?>'
                document.getElementsByName("phone")[0].value = '<?php echo $address->phone; ?>'

                lockFieldSet('user_address-fieldset')
            } else if(name === "user_bank") {
                document.getElementsByName("cardname")[0].value = '<?php echo $bankinfos->name; ?>'
                document.getElementsByName("cardtype")[0].value = '<?php echo $bankinfos->type; ?>'
                document.getElementsByName("cardnumber")[0].value = '<?php echo $bankinfos->number; ?>'
                document.getElementsByName("cardexpiration")[0].value = '<?php echo $bankinfos->expiration; ?>'
                document.getElementsByName("cardcode")[0].value = '<?php echo $bankinfos->code; ?>'

                lockFieldSet('user_bank-fieldset')
            }
        }

        function updateUserInfos() {
            $.ajax({ url: '_updateAccountInfos.php',
            data: {info_type: 'user_info',
                   pseudo: document.getElementsByName("pseudo")[0].value,
                   mail: document.getElementsByName("mail")[0].value,
                   password: document.getElementsByName("password")[0].value},
            type: 'post',
            success: function(output) {
                if(output === "true") {
                    $('#toastForm').toast('show');
                    lockFieldSet('user_info-fieldset');
                }
            }});
        }

        function updateUserAddress() {
            $.ajax({ url: '_updateAccountInfos.php',
            data: {info_type: 'user_address',
                   name: document.getElementsByName("name")[0].value,
                   lastname: document.getElementsByName("lastname")[0].value,
                   address1: document.getElementsByName("address1")[0].value,
                   address2: document.getElementsByName("address2")[0].value,
                   city: document.getElementsByName("city")[0].value,
                   postcode: document.getElementsByName("postcode")[0].value,
                   country: document.getElementsByName("country")[0].value,
                   phone: document.getElementsByName("phone")[0].value,
                   },
            type: 'post',
            success: function(output) {
                if(output === "true") {
                    $('#toastForm').toast('show');
                    lockFieldSet('user_address-fieldset');
                }
            }});
        }

        function updateUserBankinfos() {
            $.ajax({ url: '_updateAccountInfos.php',
            data: {info_type: 'user_bank',
                   cardname: document.getElementsByName("cardname")[0].value,
                   cardtype: document.getElementsByName("cardtype")[0].value,
                   cardnumber: document.getElementsByName("cardnumber")[0].value,
                   cardexpiration: document.getElementsByName("cardexpiration")[0].value,
                   cardcode: document.getElementsByName("cardcode")[0].value,
                   },
            type: 'post',
            success: function(output) {
                console.log(output)
                if(output === "true") {
                    $('.#toastForm').toast('show');
                    lockFieldSet('user_bank-fieldset');
                }
            }});
        }

        function removeSeller(id) {
            $.ajax({ url: '_removeSeller.php',
            data: {id: id},
            type: 'post',
            success: function(output) {
                if(output === "true") {
                    document.location.reload(true);
                }
            }});
        }

        function acceptOffer(buyer_id, seller_id, item_id, price) {
            $.ajax({ url: '_manageOffer.php',
            data: { input: 'accept', 
                    buyer_id: buyer_id,
                    seller_id: seller_id,
                    item_id: item_id,
                    price: price},
            type: 'post',
            success: function(output) {
                console.log(output)
                if(output === "true") {
                    document.location.reload(true);
                }
            }});
        }

        function refuseOffer(offer_id, value) {
            $.ajax({ url: '_manageOffer.php',
            data: { input: 'refuse', 
                    offer_id: offer_id,
                    value: value},
            type: 'post',
            success: function(output) {
                console.log(output)
                if(output === "true") {
                    document.location.reload(true);
                }
            }});
        }

        function deleteOffer(offer_id) {
            $.ajax({ url: '_manageOffer.php',
            data: { input: 'delete', 
                    offer_id: offer_id},
            type: 'post',
            success: function(output) {
                console.log(output)
                if(output === "true") {
                    document.location.reload(true);
                }
            }});
        }
    </script>
        <script>
      (function() {
        'use strict';
        window.addEventListener('load', function() {
            <?php if($addfunds != null) {
                echo "$('#toastFunds').delay(0).toast('show');"; } ?>
            
            $('#deleteVendorModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var seller = button.data('seller')
                var seller_id = button.data('seller_id');
                
                var modal = $(this)
                modal.find('.modal-body').find('p').text('Le vendeur "' + seller + '" va être supprimé. Cliquez sur Valider pour confirmer')
                modal.find('.modal-body').find('.btn-primary').click(function() {
                    removeSeller(seller_id);
                })
            })

            $('#deleteVendorModal').on('hide.bs.modal', function (event) {
                var modal = $(this)
                modal.find('.modal-body').find('.btn-primary').off('click')
            })

            $('#propositionModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var offer = button.data('offer')

                var modal = $(this)
                modal.find('.modal-body').find('#proposition-form').find('.form-group').find('#offer_id').attr('value', offer)
            })
                        
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
              }
              else {
                  if(form.attributes.name.value === "user_info-form") {
                      updateUserInfos();
                  } else if(form.attributes.name.value === "user_address-form") {
                      updateUserAddress();
                  } else if(form.attributes.name.value === "user_bank-form") {
                      updateUserBankinfos();
                  }

                  form.classList.remove('was-validated');
              }
            }, false);
          });
        }, false);
      })();
    </script>
    <style type="text/css"> 

    .container {
        width: 35%;
        border: solid 6px grey;
        border-radius: 50px;
        margin-top: 50px;
    }

    .infos .col {
        margin-top: 0px;
    }

    .infos .col .info-title {
        font: bold 14px sans-serif;
    }

    .profile-header {
        transform: translateY(5rem);
    }

    body {
        background: url('index_background.jpg') no-repeat center center fixed;

        /*background: #654ea3;
        background: -webkit-linear-gradient(to right, #654ea3, #eaafc8);
        background: linear-gradient(to right, #654ea3, #eaafc8);
        min-height: 100vh;*/
    }

    .accordion {
        width:100%;
    }

    .label-column {
        text-align: right;
    }

    .input-colum {
        width: 100%;
    }

    .custom-form {
        padding-top: 5%;
        padding-bottom: 5%;
    }

    .form-control {
        color: black;
    }

    .form-control:disabled {
        color: grey;
    }

    .form-control:focus {
        color: black;
    }

    .btn-validate {
        width: 30%;
        margin: auto 5%;
    }

    .topbox {
        border-radius: 10px;
    }

    .overflow {
        overflow-x: scroll;
    }

    .img-container {
        overflow: hidden;   
        display: inline-block;
        padding: 0;
        margin: 0 10px;
    }

    .img-container img {
        transition: transform .4s;
        display: block;
    }

    .img-container:hover img{
        transform: scale(1.3);
        transform-origin: 50% 50%;
    }

    .view-item-btn {
        position: absolute;
        margin-left: auto;
        margin-right: auto;
        left: 0;
        right: 0;
        margin-top: auto;
        margin-bottom: auto;
        top: 0px;
        bottom: 0px;
        height: 15%;
        visibility: hidden;
    }

    .img-container:hover .view-item-btn {
        visibility: visible;
    }

    .item_title {
        background: linear-gradient(to bottom right, #ffffffe3, #ffffff00);
        top: 0;
        width: 100%;
        padding-top: 20px;
        padding-bottom: 20px;
        position: absolute;
        padding-left: 10px;
        min-height: 27%;
        color: black;
    }

    .item_price {
        color: wheat;
        bottom: 16px;
        right: 32px;
        position: absolute;
    }

    </style>
</head>

<body>
    <?php include '_navbar.php';
        displayNavbar();
    ?>
    <div class="container-fluid">
    <div class="row py-5">
    <div class="col-xl-5 col-md-6 col-sm-10 mx-auto">

        <div class="bg-white shadow overflow-hidden topbox text-center">
            <div class="px-4 pt-0 pb-4 bg-dark">
                <div class="media align-items-end profile-header">
                    <div class="profile mr-3">
                        <img src="https://d19m59y37dris4.cloudfront.net/university/1-1-1/img/teacher-4.jpg" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                        <!--a href="#" class="btn btn-dark btn-sm btn-block">Modifier mes infos</a-->
                    </div>
                    <div class="media-body mb-5 text-white text-left">
                        <h4 class="mt-0 mb-0"><?php echo $user->pseudo; ?></h4>
                        <p class="small mb-4"> <i class="fa fa-map-marker mr-2"></i><?php echo $user->type; ?></p>
                    </div>
                </div>
            </div>
            <?php showTransactionInfos($user) ?>

            <div class="py-4 px-4 text-left" >
                <div class="accordion" id="accordionExample">
                    <?php 
                        showUserInfos($user);

                        if($user->type == "Acheteur") {
                            showUserAddress($address);
                            showUserBankinfos($bankinfos);
                            showBuyerPropositions();
                        }else if($user->type == "Vendeur") {
                            showUserBankinfos($bankinfos);
                            showVendorPropositions();
                        }
                    ?>  
                </div>
                <?php showMyItems($user) ?>
            </div>
        </div>
    </div>
    <div class="toast" id="toastForm" data-delay="5000" style="position: fixed; top: 30px; right: 15px;">
        <div class="toast-header">
            <strong class="mr-auto">Ebay ECE vous indique</strong>
            <small>à l'instant</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Vos informations ont bien été modifiées!
        </div>
    </div>

    <div class="toast" id="toastFunds" data-delay="5000" style="position: fixed; top: 30px; right: 15px;">
        <div class="toast-header">
            <strong class="mr-auto">Ebay ECE vous indique</strong>
            <small>à l'instant</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Vous avez ajouté <?php if($addfunds != null) { echo $addfunds; } ?> € à votre solde !
        </div>
    </div>

    <div class="modal fade" id="propositionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Faire une contre-offre</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="proposition-form" method="post" action="_manageOffer.php" novalidate>
                        <div class="form-group">
                            <label for="price" class="col-form-label">Veuillez entrer le nouveau montant auquel vous souhaitez négocier l'objet</label>
                            <input type="number" class="form-control" id="proposition-price" name="amount" min="1" required>
                            <input name="input" value="contre-offre" hidden>
                            <input id ="offer_id" name="offer_id" value="" hidden>
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
    <div class="modal fade" id="addFundModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter des fonds</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="addfund-form" method="post" action="_addFunds.php" novalidate>
                        <div class="form-group">
                            <label for="price" class="col-form-label">Quel montant souhaitez-vous transférer sur votre compte ?</label>
                            <input type="number" class="form-control" id="addfund-price" name="amount" min="1" required>
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
    <?php if($user->type == "Admin") {
        echo '<div class="modal fade" id="deleteVendorModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Supprimer un vendeur</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                    <div class="text-right">
                        <button type="button" class="btn btn-secondary text-right" data-dismiss="modal">Annuler</button>
                        <button data-dismiss="modal" class="btn btn-primary text-right">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    } ?>
</body>