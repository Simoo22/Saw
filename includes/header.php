<?php //ini_set('display_errors', 0);
session_start();?>

<nav class="navbar navbar-expand-lg sticky-top navbar-light" style="background: white; height: 60px;" >
  <a class="navbar-brand" href="/index.php">
    <img src="/images/logo.png" width="130" height="50" alt="Logo">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="background: white; ">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/chi_siamo.php">Chi siamo?</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mr-4" href="/funzionamento.php">Funzionamento</a>
      </li>

      <li class="nav-item">
      <form class="form-inline my-2 my-lg-0 " action="/php/search.php" method="get">
        <input class="form-control mr-sm-2" type="search" placeholder="Ricerca News" name="string" aria-label="Search">
        <input class="small-redbutton bgcolor my-2 my-sm-0" type="submit" value=" CERCA " style="height: 40px; line-height: 38px;">
      </form>
    </li>
    </ul>

    <?php

    require_once($path."/db/mysql_credentials.php");


    $con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);
    if(isset($_SESSION['email'])) {

      $email = $_SESSION['email'];
      $query = "SELECT id,nome,cognome,immagine_profilo from Utenti WHERE email ='$email'";

      $res = mysqli_query($con,$query);
      mysqli_close($con);
      $row= mysqli_fetch_array($res);
      mysqli_free_result($res);
      $user_id = $row['id'];
      $first_name = $row['nome'];
      $last_name = $row['cognome'];
      $user_image = $row['immagine_profilo'];

      echo " <div class='nav-item dropdown'>
      <a class='text-dark mr-2' href='/show_profile.php' id='navbarDropdown' role='button'
        data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$first_name $last_name</a>
        <a class='navbar-brand' href='/show_profile.php'>";
          if($user_image != null) echo "<img src='/images/users/$user_image' width='25' height='25' alt='' class='mr-3 rounded-circle'>";
          else echo "<img src='/images/users/default-avatar.jpg' width='25' height='25' alt='' class='mr-3 rounded-circle'>";
          echo "
        </a>
      <div class='dropdown-menu  dropdown-menu-right' aria-labelledby='navbarDropdown'>
      <a class='dropdown-item' href='/show_profile.php'>Profilo</a>
      <a class='dropdown-item' href='/editprofile.php'>Modifica profilo</a>
      <div class='dropdown-divider'></div>
      <a class='dropdown-item' href='/php/logout.php'>Logout</a>
      </div>
      </div>";
    } else {
      echo "
      <div>
      <ul class='navbar-nav navbar-right'>
      <li class='nav-item'><a class='nav-link' href='/singup.php'>Registrati</a></li>
      <li class='nav-item dropdown'>
      <a class='nav-link' href='' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      Accedi
      </a>
      <div class='dropdown-menu dropdown-menu-right'>
      <form class='px-4 py-3' id='loginform' action='/php/login.php' method='POST'>
      <div class='form-group'>
      <label for='email'>Email</label>
      <input type='email' class='form-control' id='email' name='email' placeholder='email@example.com' >
      </div>
      <div class='form-group'>
      <label for='pass'>Password</label>
      <input type='password' class='form-control' id='pass' name='pass' placeholder='Password'>
      <a href='/php/gestione_account/recupera_password.php' class='text-dark'><small>Password dimenticata?</small></a>
      </div>
      <div class='form-check'>
      <input type='checkbox' class='form-check-input' id='dropdownCheck2'>
      <label class='form-check-label' for='dropdownCheck2'>Remember me</label>
      <div class='dropdown-divider'></div>
      </div>
      <div class='row justify-content-center'>
      <div class='dropdown-item'>
      <a href='/singup.php' class='text-dark'>Sei nuovo qui? Registrati!</a>
      </div>
      <button type='submit' class='btn small-redbutton' value='Submit' onClick='return validation();'>Accedi</button>
      </div>
      </form>
      </div>
      </li>
      </ul>
      </div>
      <script>
        function validation() {
          var form = document.getElementById('loginform');
          if(!validateEmail(form.email.value)) {
            return false;
          }
          if(form.pass.value.length < 6) {
            return false;
          }
          return true;
        }

          function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
          }
      </script>";
    }
    ?>

  </div>
</nav>
<br>
<br>
