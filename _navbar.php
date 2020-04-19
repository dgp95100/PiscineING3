<?php

 $navbar_options = array ('home'               => '<li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>',
                          'categories'         => '<li class="nav-item dropdown">
                                                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Catégories
                                                      </a>
                                                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                        <a class="dropdown-item" href="categories.php">Recherche</a>
                                                        <a class="dropdown-item" href="item_list.php?category=1">Ferraille ou trésor</a>
                                                        <a class="dropdown-item" href="item_list.php?category=2">Bon pour le musée</a>
                                                        <a class="dropdown-item" href="item_list.php?category=3">Accessoires VIP</a>
                                                      </div>
                                                    </li>',
                          'sell'               => '<li class="nav-item"><a class="nav-link" href="sell_item.php">Vendre</a></li>',
                          'my_items'           => '<li class="nav-item"><a class="nav-link" href="#">Mes items</a></li>',
                          'proposals'          => '<li class="nav-item"><a class="nav-link" href="#">Mes propositions d\'offres</a></li>',
                          'sellers_management' => '<li class="nav-item"><a class="nav-link" href="account.php#vendor">Gestion des vendeurs</a></li>',
                          'cart'               => '<li class="nav-item"><a class="nav-link" href="cart.php">Panier  <span class="badge badge-pill badge-primary">%COUNT%</span><i class="fas fa-shopping-cart fa-lg"></i></a></li>',
                          'account'            => '<li class="nav-item"><a class="nav-link" href="account.php">Mon compte  <i class="fas fa-user-circle fa-lg"></i></a></li>',
                          'register'           => '<li class="nav-item"><a class="nav-link" href="register.php">S\'inscrire  <i class="fas fa-user-circle fa-lg"></i></a></li>',
                          'login'              => '<li class="nav-item"><a class="nav-link" href="login.php">Se connecter  <i class="fas fa-user-circle fa-lg"></i></a></li>',  
                          'disconnect'         => '<li class="nav-item"><a class="nav-link" href="login.php?disconnect">Se déconnecter  <i class="fas fa-user-circle fa-lg"></i></a></li>'
                        );

  function displayBuyerNavbarOptions($navbar_options) {
    echo '<ul class="navbar-nav">';
    echo $navbar_options['home'];
    echo $navbar_options['categories'];
    echo '</ul>';
    echo '<ul class="navbar-nav ml-auto">';
    echo str_replace('%COUNT%', isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0, $navbar_options['cart']);
    echo $navbar_options['account'];
    echo $navbar_options['disconnect'];
    echo '</ul>';
  }

  function displaySellerNavbarOptions($navbar_options) {
    echo '<ul class="navbar-nav">';
    echo $navbar_options['home'];
    echo $navbar_options['categories'];
    echo $navbar_options['sell'];
    echo $navbar_options['my_items'];
    echo $navbar_options['proposals'];
    echo '</ul>';
    echo '<ul class="navbar-nav ml-auto">';
    echo $navbar_options['account'];
    echo $navbar_options['disconnect'];
    echo '</ul>';
  }

  function displayAdminNavbarOptions($navbar_options) {
    echo '<ul class="navbar-nav">';
    echo $navbar_options['home'];
    echo $navbar_options['categories'];
    echo $navbar_options['sellers_management'];
    echo '</ul>';
    echo '<ul class="navbar-nav ml-auto">';
    echo $navbar_options['account'];
    echo $navbar_options['disconnect'];
    echo '</ul>';
  }

  function displayVisitorNavbarOptions($navbar_options) {
    echo '<ul class="navbar-nav">';
    echo $navbar_options['home'];
    echo $navbar_options['categories'];
    echo '</ul>';
    echo '<ul class="navbar-nav ml-auto">';
    echo $navbar_options['register'];
    echo $navbar_options['login'];
    echo '</ul>';
  }

  function displayNavbarOptions($user_type) {
    global $navbar_options;

    if($user_type == 'Admin') {
      displayAdminNavbarOptions($navbar_options);
    } else if($user_type == 'Vendeur') {
      displaySellerNavbarOptions($navbar_options);
    } else if($user_type == 'Acheteur') {
      displayBuyerNavbarOptions($navbar_options);
    } else if($user_type == "Visitor") {
      displayVisitorNavbarOptions($navbar_options);
    } else {
      die('Error: unrecognized user type');
    }
  }

  function displayNavbar() {
    $user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : 'Visitor';

    echo '<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="#">
              <img src="logo.png" alt="logo" style="width:60px;">
            </a>';
        
    displayNavbarOptions($user_type);

    echo '</nav>';
  }
?>