<?php

  $path = $_SERVER['DOCUMENT_ROOT'];
  require_once($path."/db/mysql_credentials.php");

  fuction check_input($string) {
    if (!preg_match('/[^A-Za-z0-9]/', $string)) {
      return false;
    }
    return true;
  }

  $con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
   $token = "FgUftotbLBUWjwDXCDOhCBX6rb1UkxBj";
  if(!$con) {
    echo "Impossibile connettersi al server.";
  } else {
    if(check_input($_GET['user'])) {
    $key = $_GET['user'];
    $query = "UPDATE utenti SET verified=1 WHERE md5(concat(email, '$token'))='$key'";
    $res = mysqli_query($con,$query);
    $num = mysqli_affected_rows($con);
    if($num == 1) {
      echo "
      <script>
      alert('Benvenuto!');
      </script>";
      header("location: /index.php");
    } else {
      echo "Errore";
    }
  } else {
    echo "error";
  }
  }

  ?>
