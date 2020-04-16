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
        html, body, header, .container-fluid {
            height: 100%;
        }
        .container-fluid {
            background: transparent url('index_background.jpg') no-repeat center center;
            background-size: cover;
            padding: 0;
        }

        .intro-div {
            margin-bottom: 25px;
            margin-top: 150px;            
            text-align: center;
            align-items: center;
        }

        .title {
            font: bold 64px sans-serif;
            text-shadow: 2px 2px 5px cornflowerblue;
            color: blanchedalmond;
        }

        .subtitle {
            font: italic 30px sans-serif;
            margin-top: 30px;
            color: blanchedalmond;
            width: 40%;
        }

        .buttons {
            margin-top: 50px;
        }

        .btn {
            font: bold 20px sans-serif;
            background: linear-gradient(40deg, #ffd86f, #fc6262);
            border-radius: 50px;
            display: inline-block;
            border: none;
            width: 200px;
            height: 70px;
            color: blanchedalmond;
            margin: 50px;
        }

        .btn :hover {
            color: blueviolet;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <?php include '_navbar.php';
            displayNavbar();
        ?>
        
        <div class="intro-div d-flex flex-column">
            <div class="title">Bienvenue sur ebay ECE</div>
            <div class="subtitle">Ici se tiendra un petit texte d'introduction pour présenter notre site web ainsi que les différentes fonctionnalités qui s'y trouvent</div>
            <div class="buttons">
                <a href="account.php"><button class="btn btn-lg">MON COMPTE</button></a>
                <button class="btn btn-lg">CATEGORIES</button>
            </div>
        </div>

    </div>
</body>
</html>