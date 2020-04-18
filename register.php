<!DOCTYPE html>
<html> <!-- page de creation de compte, audra voir pour le type de compte (vendeur, acheteur, admin) defaçon à optimiser le site-->

<head>
    <title>Q5</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- on change pas les bails :) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5ff10a469d.js" crossorigin="anonymous"></script>
    <style type="text/css">   /* css tu connais*/
    .register-form form.custom-form {
  padding-top: 55px;
  padding-left: 55px;
  padding-right: 55px;
  box-sizing: border-box;
  background-color: #ffffff;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
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
  border-radius: 2px;
  color: #ffffff;
  font-weight: bold;
  box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
  padding: 14px 22px;
  border: 0;
  margin: 30px;
  outline: none;
}

.invalid_input {
  margin-top: 12px;
  margin-left: 5px;
  margin-bottom: -15px;
  color: red;
}
    </style>
    <script>
      function checkIfUsernameIsAlreadyTaken(element) {       // mêmes types de fonctions que pour la page login //
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

      function a() {
        console.log("here");
        document.getElementsByName("pseudo")[0].setCustomValidity('Username already taken');
      }

      function checkPasswordMatch() {
        if (document.getElementsByName("password_confirmation")[0].value != document.getElementsByName("password")[0].value) {
          document.getElementsByName("password_confirmation")[0].setCustomValidity('Password Must be Matching.');
        } else {
            document.getElementsByName("password_confirmation")[0].setCustomValidity('');
        }
      }
    </script>
    <script>
      // Source : https://getbootstrap.com/docs/4.4/components/forms/#validation
      // petit Exemple de starter JavaScript for disabling form submissions si un champ est invalide
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              console.log("submit");
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
</head>

<body>
    <?php
    include '_navbar.php'; 
    displayNavbar(); ?>
 
    <div class="row register-form">  <!-- le formulaire est ici! -->
        <div class="col-md-8 offset-md-2">
            <form class="custom-form needs-validation" method="POST" action="confirm_registration.php" novalidate>
                <h1>Inscription</h1>
                <div class="form-row form-group" id="pseudo_div">
                    <div class="col-sm-3 label-column"><label class="col-form-label" for="name-input-field">Pseudo </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="text" name="pseudo"  oninput="checkIfUsernameIsAlreadyTaken(this)" required>
                      <div class="invalid-feedback pseudo-invalid">Ce champ est obligatoire</div> <!-- pour pas que l'utilisateur l'oublie XD -->
                    </div>
                </div>
                <div class="form-row form-group" id="mail_div">
                    <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">Email </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="email" name="mail" required>
                      <div class="invalid-feedback">Ce champ est obligatoire</div>
                    </div>
                </div>
                <div class="form-row form-group" id="password_div">
                    <div class="col-sm-3 label-column"><label class="col-form-label" for="pawssword-input-field">Mot de passe </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="password" name="password" oninput="checkPasswordMatch(this)" required>
                      <div class="invalid-feedback">Ce champ est obligatoire</div>
                    </div>
                </div>
                <div class="form-row form-group" id="password_confirmation_div">
                    <div class="col-sm-3 label-column"><label class="col-form-label" for="repeat-pawssword-input-field">Confirmer le mot de passe </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="password" name="password_confirmation" oninput="checkPasswordMatch(this)" required>
                      <div class="invalid-feedback">Les mots de passe ne correspondent pas</div>
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-3 label-column">
                      <label class="col-form-label" for="dropdown-input-field">Type de compte </label>
                    </div>
                    <div class="col-sm-3 input-column">
                      <select class="custom-select" id="inlineFormCustomSelect" name="status" required>
                        <option value="">Choisir...</option>
                        <option value="1">Acheteur</option>
                        <option value="2">Vendeur</option> <!-- on part du principe que le site est déjà vendu à l'admin, qui adéjà fait une première connextion dessus-->
                      </select>
                      <div class="invalid-feedback">Veuillez renseigner un type de compte</div>
                    </div>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="formCheck-1" required>
                  <label class="form-check-label" for="formCheck-1">J'ai lu et j'accepte les termes et conditions de ce site</label> <!-- la clause à accepter-->
                  <div class="invalid-feedback">Vous devez accepter nos termes et conditions</div>
                </div>
                <input class="btn btn-primary submit-button" type="submit" name="button" value="Soumettre">
              </form>
        </div>
    </div>
</body>
