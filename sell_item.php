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
    .register-form form.custom-form {
  padding-top: 55px;
  padding-left: 55px;
  padding-right: 55px;
  box-sizing: border-box;
  background-color: transparent;
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

.custom-checkbox-selector {
    font-weight: normal;
    color: black;
}

body {
      background: url('index_background.jpg') no-repeat center center fixed;
    }

    </style>
    <script>
      function updateSellTypes() {
        const achat_immediat = document.getElementById('customCheck1')
        const enchere = document.getElementById('customCheck2')
        const proposition = document.getElementById('customCheck3')

        document.getElementById('price-input-field').required = achat_immediat.checked
        document.getElementById('minprice-input-field').required = enchere.checked
        document.getElementById('date-input-field').required = enchere.checked

        if(achat_immediat.checked) {
          document.getElementById('price_div').hidden = false
        } else {
          document.getElementById('price_div').hidden = true
        }

        if(enchere.checked) {
          document.getElementById('minprice_div').hidden = false
          document.getElementById('date_div').hidden = false
          proposition.disabled = true
        } else {
          document.getElementById('minprice_div').hidden = true
          document.getElementById('date_div').hidden = true
          proposition.disabled = false
        }

        if(proposition.checked) {
          enchere.disabled = true
        } else {
          enchere.disabled = false
        }

        if(!achat_immediat.checked && !enchere.checked && !proposition.checked) {
          achat_immediat.required = true
          enchere.required = true
          proposition.required = true
        } else {
          achat_immediat.required = false
          enchere.required = false
          proposition.required = false
        }
      }

      /*function addItemToDatabase() {
        $.ajax({ url: '_addItemToDatabase.php',
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
      }*/
      
    </script>
    <script>
      // Source from: https://getbootstrap.com/docs/4.4/components/forms/#validation
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

          window.addEventListener('load', function() {
            document.querySelector('.custom-file-input').addEventListener('change',function(e){
              let file_count = document.getElementById("customFile").files.length;
              var nextSibling = e.target.nextElementSibling

              nextSibling.innerText = file_count + (file_count > 1 ? ' images selectionnées' : ' image selectionnée');
            })
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
              else {
                // addItemToDatabase();
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
 
    <div class="row register-form">
        <div class="col-md-8 offset-md-2">
            <form class="custom-form needs-validation" enctype="multipart/form-data" method="POST" action="_addItemToDatabase.php" novalidate>
                <h1>Ajouter une annonce</h1>
                <div class="form-row form-group" id="name_div">
                    <div class="col-sm-3 label-column"><label class="col-form-label" for="name-input-field">Titre de l'annonce* </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="text" name="title" required>
                      <div class="invalid-feedback pseudo-invalid">Ce champ est obligatoire</div>
                    </div>
                </div>
                <div class="form-row form-group" id="short_desc_div">
                    <div class="col-sm-3 label-column"><label class="col-form-label" for="shortdesc-input-field">Sous-titre </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="text" name="short_desc" maxlength="255">
                    </div>
                </div>
                <div class="form-row form-group" id="long_desc_div">
                    <div class="col-sm-3 label-column"><label class="col-form-label" for="longdesc-input-field">Description </label></div>
                    <div class="col-sm-6 input-column">
                      <textarea class="form-control" rows="8" name="long_desc"></textarea>
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-3 label-column">
                        <label class="col-form-label mt-3" for="dropdown-input-field">Type de vente* </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="achat-immediat" onclick="updateSellTypes()" required>
                            <label class="custom-control-label custom-checkbox-selector pt-1" for="customCheck1">Achat immédiat</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck2" name="enchere" onclick="updateSellTypes()" required>
                            <label class="custom-control-label custom-checkbox-selector pt-1" for="customCheck2">Vente aux enchères</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck3" name="proposition" onclick="updateSellTypes()" required>
                            <label class="custom-control-label custom-checkbox-selector pt-1" for="customCheck3">Proposition d'offre</label>
                            <div class="invalid-feedback">Veuillez renseigner au moins 1 type de vente</div>
                        </div>
                    </div>
                    <div class="col-sm-2 label-column">
                        <label class="col-form-label" for="dropdown-input-field">Catégorie* </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <select class="custom-select" id="inlineFormCustomSelect" name="category" required>
                            <option value="">Choisir...</option>
                            <option value="1">Ferraille ou trésor</option>
                            <option value="2">Bon pour le musée</option>
                            <option value="3">Accessoires VIP</option>
                        </select>
                        <div class="invalid-feedback">Veuillez renseigner une catégorie</div>
                    </div>
                </div>
                <div class="form-row form-group" id="price_div" hidden>
                    <div class="col-sm-3 label-column"><label class="col-form-label" for="price-input-field">Prix (achat immédiat)* </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="number" name="price" id="price-input-field" required>
                      <div class="invalid-feedback">Ce champ est obligatoire</div>
                    </div>
                </div>
                <div class="form-row form-group" id="minprice_div" hidden>
                    <div class="col-sm-3 label-column"><label class="col-form-label" for="minprice-input-field">Prix de départ (vente aux enchères)* </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="number" name="minprice" id="minprice-input-field" required>
                      <div class="invalid-feedback">Ce champ est obligatoire</div>
                    </div>
                </div>
                <div class="form-row form-group" id="date_div" hidden>
                    <div class="col-sm-3 label-column"><label class="col-form-label" for="date-input-field">Date de fin de l'enchère* </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="date" name="date" id="date-input-field" required>
                      <div class="invalid-feedback">Ce champ est obligatoire</div>
                    </div>
                </div>
                <div class="form-row form-group">
                  <div class="col-sm-3 label-column"><label class="col-form-label" for="myfile">Ajouter des photos*</label></div>
                  <div class="col-sm-6 input-column">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="imgs[]" multiple required>
                      <label class="custom-file-label" for="customFile">Choisir des fichiers</label>
                      <div class="invalid-feedback">Vous devez ajouter au moins 1 image</div>
                    </div>
                  </div>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck4" required>
                    <label class="custom-control-label pt-1" for="customCheck4">Je certifie que cette annonce ne va pas à l'encontre de notre <a href="#">politique de vente</a></label>
                    <div class="invalid-feedback">Ce champ est obligatoire</div>
                </div>
                <input class="btn btn-primary submit-button" type="submit" name="button" value="Soumettre">
              </form>
        </div>
    </div>
</body>
