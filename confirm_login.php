<?php include '_security.php';
    validateCreditentials(); ?>
    
<!DOCTYPE html> <!-- ce sera une page qui se lancera instant après une connexion réussie-->
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
        html, body {
            margin: 0;
            height: 100%;
        }
    </style>
</head>

<body class="text-center">
    <?php 
        include '_navbar.php';
        displayNavbar(); 
    ?>
    <div class="cover-container d-flex justify-content-center h-50 p-3 mx-auto flex-column">
        <h1 class="cover-heading">Bienvenue, <?php echo $_SESSION['user_name'] ?></h1>
        <p class="lead">Connexion réussie. Vous pouvez désormais accéder à votre compte</p>
        <p class="lead">
          <a href="account.php" class="btn btn-lg btn-primary">Mon compte</a>
        </p>
    </div>
</body>
