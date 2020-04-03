<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registrazione</title>
  <meta content="author" name="Caruso Simone">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
</head>
<body>
  <?php
  $path = $_SERVER['DOCUMENT_ROOT'];
  include($path."/php/header.php");
  ?>

  <style media="screen">
  .submitbutton {
    border: 1px solid #c33332;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    height: 47px;
    padding: 0 29px;
    text-transform: uppercase;
    background: none;
    border-radius: 4px;
    line-height: 45px;
    background-color: #c33332;
  }
  </style>

  <div class="container border border-dark" > <br>
    <div class="container">
      <form class="needs-validation" action="/php/registration.php" method="post" onsubmit="return check_input();" novalidate>
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="firstname"><b>Nome</b></label>
            <input type="text" class="form-control text-dark" name="firstname" id="firstname" placeholder="Mario" onfocus="return removeInvalid(this);" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="lastname"><b>Cognome</b></label>
            <input type="text" class="form-control text-dark" name="lastname" id="lastname" placeholder="Rossi" onfocus="return removeInvalid(this);" required>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="email"><b>E-mail</b></label>
          <input type="email" class="form-control text-dark" name="email" id="email" placeholder="nome@example.com" onfocus="return removeInvalid(this);" required>
        </div>
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="pass"><b>Password</b></label>
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" onfocus="return removeInvalid(this);" required>
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
        <button class="submitbutton" type="submit">Submit</button>
      </form>

      <!-- <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          var pass = document.getElementById('pass');
          var confirm = document.getElementById('confirm');
          if(pass.value.length<6) {
            //document.getElementById("diverror").innerHTML = "Password is too weak(min.6).";
            //confirm.classList.add("is-invalid");
          }
          confirm.classList.add(" is-invalid");
          if(pass.value != confirm.value) {
            document.getElementById("diverror").innerHTML = "Passwords missmatch.";
          }
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
      </script> -->

      <br>
    </div>
  </div>
</body>
</html>

<script>
function check_input() {

  var firstname = document.getElementById('firstname');
  var lastname = document.getElementById('lastname');
  var email = document.getElementById('email');
  var pass = document.getElementById('pass');
  var confirm = document.getElementById('confirm');
  var checkbox = document.getElementById('checkbox');
  var isvalid = true;

  email.classList.add('is-valid');

  if(firstname.value == "") {
    firstname.classList.remove('is-valid');
    firstname.classList.add('is-invalid');
    isvalid = false;
  } else {
    firstname.classList.add('is-valid');
  }
  if(lastname.value == "") {
    lastname.classList.remove('is-valid');
    lastname.classList.add('is-invalid');
    isvalid = false;
  } else {
    lastname.classList.add('is-valid');
  }

  if(!checkbox.checked) {
    checkbox.classList.remove('is-valid');
    checkbox.classList.add('is-invalid');
    isvalid = false;
  } else {
    checkbox.classList.remove('is-invalid');
    checkbox.classList.add('is-valid');
  }

  if(!isEmailAddr(email.value)) {
    email.classList.remove('is-valid');
    email.classList.add('is-invalid');
  } else {
    checkbox.classList.remove('is-invalid');
    checkbox.classList.add('is-valid');
  }

  if(pass.value.length < 6) {
    document.getElementById("diverror").innerHTML = "Password too weak(min.6).";
    pass.classList.remove('is-valid');
    confirm.classList.remove('is-valid');
    pass.classList.add('is-invalid');
    confirm.classList.add('is-invalid');
    isvalid = false;
  } else if(pass.value != confirm.value) {
    document.getElementById("diverror").innerHTML = "Passwords missmatch.";
    pass.classList.remove('is-valid');
    confirm.classList.remove('is-valid');
    pass.classList.add('is-invalid');
    confirm.classList.add('is-invalid');
    confirm.value = '';
    confirm.focus();
    isvalid = false;
  } else {
    pass.classList.add('is-valid');
    confirm.classList.add('is-valid');
  }

  if(isvalid)
    return true;
  else {
    return false;
  }
}

function isEmailAddr(email) {
  var result = false;
  var theStr = new String(email);
  var index = theStr.indexOf("@");
  if (index > 0)
  {
    var pindex = theStr.indexOf(".",index);
    if ((pindex > index+1) && (theStr.length > pindex+1))
	result = true;
  }
  return result;
}

function removeInvalid(element) {
  element.classList.remove('is-invalid');
}
</script>
