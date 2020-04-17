<!DOCTYPE html>
<html>

<?php
    include '_navbar.php';

    if(isset($_GET['disconnect'])) {
        session_start();
        session_destroy();

      $_SESSION['user_type'] = 'Visitor';
    }
    
    function writeMail($creditentials) {
      if ($creditentials) {
        echo $_POST['mail'];
      }
    }

    function writePassword($creditentials) {
      if($creditentials) {
        echo $_POST['password'];
      }
    }

    function writeLoginNeededMessage() {
      if(isset($_GET['need_login'])) {
        echo '<h1 class="text-danger" style="border-bottom: 0">Vous devez être connecté pour accéder à cette page</h1><br>';
      }
    }
?>

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
    .register-form form.custom-form {
  padding-top: 55px;
  padding-left: 55px;
  padding-right: 55px;
  box-sizing: border-box;
  background-color: transparent;
  font: bold 14px sans-serif;
  text-align: center;
  margin: 50px;
  color: #333;
}

@media (max-width:400px) {
  .register-form form.custom-form {
    padding: 55px 10px;
  }
}

.register-form .custom-form h1 {
  display: inline-block;
  color: #4c565e;
  font-size: 24px;
  font-weight: bold;
  padding: 0 10px 15px;
  margin-bottom: 60px;
  border-bottom: 2px solid rgb(108, 174, 224);
}

.register-form .custom-form .form-group {
  margin-bottom: 25px;
}

.register-form .custom-form .label-column {
  text-align: right;
  color: #5F5F5F;
}

@media (max-width:768px) {
  .register-form .custom-form .label-column {
    text-align: left;
  }
}

.register-form .custom-form .input-column {
  color: #5f5f5f;
  text-align: left;
}

.register-form .custom-form .input-column input {
  color: #5f5f5f;
  box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
  padding: 12px;
  border: 1px solid #dbdbdb;
  border-radius: 2px;
  height: 42px;
}

.register-form .custom-form .dropdown .dropdown-toggle {
  background: #fff;
  border: 1px solid #dbdbdb;
  box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
  color: #333;
  outline: none;
}

.register-form .custom-form .dropdown ul {
  background: #fff;
}

.register-form .custom-form .dropdown ul li a {
  background: #fff;
  color: #333;
  opacity: 0.8;
}

.register-form .custom-form .dropdown ul li a:hover {
  opacity: 1;
}

.register-form .custom-form .submit-button {
  color: #ffffff;
  font-weight: bold;
  box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
  padding: 14px 22px;
  border: 0;
  margin: 30px;
  margin-bottom: 145px;
  outline: none;
}

.invalid_input {
  margin-top: 12px;
  margin-left: 5px;
  margin-bottom: -15px;
  color: red;
}

.btn {
            background: linear-gradient(40deg, #ffd86f, #fc6262);
            border-radius: 8px;
            border: none;
            color: blanchedalmond;
            margin: 5%;
            margin-top: 1%;
            width: 20%;
            min-width: 210px;
            padding: 20px 25px;
            padding-bottom: 15px;
            display: inline-block;
            font-size: 25px;
            white-space: nowrap;
        }

    body {
      background: url('index_background.jpg') no-repeat center center fixed;
    }

    </style>
    <script>
      function checkCreditentials() {     
        $.ajax({ url: '_areCreditentialsValid.php',
         data: {mail: document.getElementById('mail-input').value, 
                password: document.getElementById('password-input').value},
         type: 'post',
         success: function(output) {
           if(output == "true") {
            passwordIsCorrect();
           }
           else {
             passwordIsIncorrect();
           }
        }});
      }

      function passwordIsCorrect() {
        document.getElementsByName("password")[0].setCustomValidity('');
        window.location = 'index.php?redirect=0';
      }

      function passwordIsIncorrect() {
        document.getElementsByName("password")[0].setCustomValidity('Mot de passe incorrect');
        document.getElementsByClassName('password-invalid')[0].innerText = "Incorrect password";
        document.getElementById('main-form').classList.add('was-validated');
      }
    </script>
</head>

<body>
    <?php displayNavbar(); ?>
    
    <div class="container-fluid">
      <div class="row register-form">
          <div class="col-md-8 offset-md-2">
              <form class="custom-form needs-validation" method="POST" id ="main-form" style="padding-top: <?php echo (isset($_GET['need_login']) ? "100" : "180"); ?>px;"novalidate>
                  <?php writeLoginNeededMessage(); ?>
                  <h1>Connexion</h1>
                  <div class="form-row form-group" id="mail_div">
                      <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Email </label></div>
                      <div class="col-sm-4 input-column">
                        <input class="form-control" type="email" name="mail" id="mail-input" required>
                        <div class="invalid-feedback">Ce champ est obligatoire</div>
                      </div>
                  </div>
                  <div class="form-row form-group" id="password_div">
                      <div class="col-sm-4 label-column"><label class="col-form-label" for="pawssword-input-field">Mot de passe </label></div>
                      <div class="col-sm-4 input-column">
                        <input class="form-control" type="password" name="password" id="password-input" required>
                        <div class="invalid-feedback password-invalid">Ce champ est obligatoire</div>
                      </div>
                  </div>
                  <div class="row d-flex justify-content-center">
                      <p>Pas de compte ? <a href="register.php">Inscrivez vous !</a></p>
                  </div>
                  <input class="btn btn-primary submit-button" name="button" onclick="checkCreditentials()" value="Se connecter">
                </form>
          </div>
      </div>
    </div>
</body>
