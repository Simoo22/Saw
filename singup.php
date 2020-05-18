<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registrazione</title>
  <meta content="author" name="Caruso Simone">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
</head>
<body>
  <?php
  $path = $_SERVER['DOCUMENT_ROOT'];
  include($path."/includes/header.php");
  ?>

  <div class="container border border-dark" > <br>
    <div class="container">
      <form class="needs-validation" id="form" action="/php/registration.php" method="post" onsubmit="return validate_form();" novalidate>
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="firstname"><b>Nome</b></label>
            <input type="text" class="form-control text-dark" name="firstname" id="firstname" placeholder="Mario"  required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="lastname"><b>Cognome</b></label>
            <input type="text" class="form-control text-dark" name="lastname" id="lastname" placeholder="Rossi" required>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="email"><b>E-mail</b></label>
            <input type="email" class="form-control text-dark" name="email" id="email" placeholder="nome@example.com" required>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="pass"><b>Password</b></label>
            <input type="password" class="form-control" name="pass" placeholder="Password" required>
          </div>
          <div class="col-md-4 mb-3" >
            <label for="confirm"><b>Confirm Password</b></label>
            <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Password" required>
            <div class="invalid-feedback" id="diverror">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="checked" id="checkbox" name="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
              Agree to <a href="#">terms and conditions</a>
            </label>
            <div class="invalid-feedback">
              You must agree before submitting.
            </div>
          </div>
        </div>
        <button class="big-redbutton" type="submit">Registrati</button>
      </form>
      <br>
    </div>
  </div>

  <div class="mt-5" >
    <?php include($path."/includes/footer.html"); ?>
  </div>

  <script>
  function validate_form() {
    var form = document.getElementById('form');
    form.classList.add('was-validated');

    if(form.firstname.value == "" || !form.firstname.value.match(/^[a-z0-9\']+$/i)) {
      form.firstname.setCustomValidity("Invalid");
    } else {
      form.firstname.setCustomValidity("");
    }

    if(form.lastname.value == "" || !form.lastname.value.match(/^[a-z0-9\']+$/i)) {
      form.lastname.setCustomValidity("Invalid");
    } else {
      form.lastname.setCustomValidity("");
    }

    if(!form.checkbox.checked) {
      form.checkbox.setCustomValidity("Invalid");
    } else {
      checkbox.setCustomValidity("");
    }

    if(form.pass.value.length < 6) {
      document.getElementById("diverror").innerHTML = "Password too weak(min.6).";
      form.pass.setCustomValidity("Invalid");
      form.confirm.setCustomValidity("Invalid");
    } else if(form.pass.value != form.confirm.value) {
      document.getElementById("diverror").innerHTML = "Passwords missmatch.";
      form.pass.setCustomValidity("Invalid");
      form.confirm.setCustomValidity("Invalid");
    } else {
      form.pass.setCustomValidity("");
      form.confirm.setCustomValidity("");
    }

    if (form.checkValidity() === false) {
      return false;
    }
  }

</script>
</body>
</html>
