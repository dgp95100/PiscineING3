<!DOCTYPE html> <!-- une page auto pour une création de compte réussie! -->
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

    <?php
    include '_navbar.php';
    include '_mysql.php';

    $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : die('An error occured while trying to create a new account');
    $mail = isset($_POST['mail']) ? $_POST['mail'] : die('An error occured while trying to create a new account');
    $password = isset($_POST['password']) ? $_POST['password'] : die('An error occured while trying to create a new account');
    $status = isset($_POST['status']) ? $_POST['status'] : die('An error occured while trying to create a new account');

    $sql = 'INSERT INTO `comptes` (`id`, `type`, `pseudo`, `mail`, `mdp`, `items`, `adresse`, `infos_bancaires`) VALUES (NULL, "' . $status . '", "' . $pseudo . '", "' . $mail . '", "' . $password . '", "", "", "");';
    $result = sql_request($sql);
    ?>

    <body class="text-center">
        <?php 
        displayNavbar(); 
        ?>
        <div class="cover-container d-flex justify-content-center h-50 p-3 mx-auto flex-column">
            <h1 class="cover-heading">Bienvenue, *prenom*</h1> <!-- cherche un moyer d'insérer le prenom de l'utilisateur, à l'avenir-->
            <p class="lead">Votre inscription a bien été enregistrée. Vous pouvez désormais</p>
            <p class="lead">
                <a href="login.php" class="btn btn-lg btn-primary">Se connecter</a>
            </p>
        </div>
    </body>
