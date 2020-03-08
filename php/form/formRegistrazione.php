<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registrazione</title>
  <meta content="author" name="Caruso Simone">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
</head>
<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>

  <?php
  $path = $_SERVER["DOCUMENT_ROOT"]."/php/";
  include($path."header.php");
  ?>

  <div class="container border border-dark" > <br>
    <div class="container">
      <form class="needs-validation" action="registration.php" method="post" novalidate>
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="firstname">Nome</label>
            <input type="text" class="form-control" name="firstname" placeholder="Mario" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="lastname">Cognome</label>
            <input type="text" class="form-control" name="lastname" placeholder="Rossi" required>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="email">E-mail</label>
          <input type="email" class="form-control" name="email" placeholder="nome@example.com">
        </div>
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="pass">Password</label>
            <input type="password" class="form-control" name="pass" placeholder="Password">
          </div>
          <div class="col-md-4 mb-3">
            <label for="confirm">Confirm Password</label>
            <input type="password" class="form-control" name="confirm" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" name="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
              Agree to terms and conditions
            </label>
            <div class="invalid-feedback">
              You must agree before submitting.
            </div>
          </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
      </form>

      <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
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

      <br>
    </div>
  </div>
</body>
</html>
