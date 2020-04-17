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
    </style>
</head>

<body>
    <?php include '_navbar.php';
        displayNavbar();
    ?>
    <div class="container-fluid">
    <div class="row py-5">
    <div class="col-xl-4 col-md-6 col-sm-10 mx-auto">

        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 bg-dark">
                <div class="media align-items-end profile-header">
                    <div class="profile mr-3">
                        <img src="https://d19m59y37dris4.cloudfront.net/university/1-1-1/img/teacher-4.jpg" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                        <a href="#" class="btn btn-dark btn-sm btn-block">Modifier mes infos</a>
                    </div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0">Pseudo</h4>
                        <p class="small mb-4"> <i class="fa fa-map-marker mr-2"></i>Vendeur</p>
                    </div>
                </div>
            </div>

            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">5</h5><small class="text-muted"> <i class="fa fa-picture-o mr-1"></i>items achetés</small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">56€</h5><small class="text-muted"> <i class="fa fa-user-circle-o mr-1"></i>Solde</small>
                    </li>
                </ul>
            </div>

            <div class="py-4 px-4" >
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Mes informations personnelles
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <a href="#"><i class="fas fa-edit"></i></a>
                                <form class="custom-form needs-validation" method="POST" action="confirm_registration.php" novalidate>                                   
                                    <div class="form-row form-group" id="pseudo_div">
                                        <div class="col-sm-3 label-column"><label class="col-form-label" for="name-input-field">Pseudo </label></div>
                                        <div class="col-sm-8 input-column">
                                        <input class="form-control" type="text" name="pseudo"  oninput="checkIfUsernameIsAlreadyTaken(this)" value="pseudo" required disabled>
                                        <div class="invalid-feedback pseudo-invalid">Ce champ est obligatoire</div>
                                        </div>
                                    </div>
                                    <div class="form-row form-group" id="mail_div">
                                        <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">Email </label></div>
                                        <div class="col-sm-8 input-column">
                                        <input class="form-control" type="email" name="mail" required disabled>
                                        <div class="invalid-feedback">Ce champ est obligatoire</div>
                                        </div>
                                    </div>
                                    <div class="form-row form-group" id="password_div">
                                        <div class="col-sm-3 label-column"><label class="col-form-label" for="pawssword-input-field">Date d'inscription </label></div>
                                        <div class="col-sm-8 input-column">
                                        <input class="form-control" type="password" name="password" oninput="checkPasswordMatch(this)" required disabled>
                                        <div class="invalid-feedback">Ce champ est obligatoire</div>
                                        </div>
                                    </div>
                                    <div class="form-row form-group" id="password_confirmation_div">
                                        <div class="col-sm-3 label-column"><label class="col-form-label" for="repeat-pawssword-input-field">Type de compte </label></div>
                                        <div class="col-sm-8 input-column">
                                        <input class="form-control" type="password" name="password_confirmation" oninput="checkPasswordMatch(this)" required disabled>
                                        <div class="invalid-feedback">Les mots de passe ne correspondent pas</div>
                                        </div>
                                    </div>
                                    <input class="btn btn-primary submit-button" type="submit" name="button" value="Soumettre" hidden>
                                </form>                            
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Mes informations de facturation
                            </button>
                        </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Mes informations bancaires
                            </button>
                        </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Recent photos</h5><a href="#" class="btn btn-link text-muted">Show all</a>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2 pr-lg-1"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556294928/nicole-honeywill-546848-unsplash_ymprvp.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
                    <div class="col-lg-6 mb-2 pl-lg-1"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556294927/dose-juice-1184444-unsplash_bmbutn.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
                    <div class="col-lg-6 pr-lg-1 mb-2"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556294926/cody-davis-253925-unsplash_hsetv7.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
                    <div class="col-lg-6 pl-lg-1"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556294928/tim-foster-734470-unsplash_xqde00.jpg" alt="" class="img-fluid rounded shadow-sm"></div>
                </div>
                <div class="py-4">
                    <h5 class="mb-3">Recent posts</h5>
                    <div class="p-4 bg-light rounded shadow-sm">
                        <p class="font-italic mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                        <ul class="list-inline small text-muted mt-3 mb-0">
                            <li class="list-inline-item"><i class="fa fa-comment-o mr-2"></i>12 Comments</li>
                            <li class="list-inline-item"><i class="fa fa-heart-o mr-2"></i>200 Likes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>