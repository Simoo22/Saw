<?php

  $path = $_SERVER['DOCUMENT_ROOT'];
  require_once($path."/db/mysql_credentials.php");

  function check_input($string) {
    if (!preg_match('/[A-Za-z0-9]/', $string)) {
      echo "$string";
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
        session_start();
        $query = "SELECT email FROM utenti WHERE md5(concat(email, '$token'))='$key'";
        $res = mysqli_query($con,$query);
        $row = mysqli_fetch_array($res);
        $_SESSION['email'] = $row['email'];
        echo "
        <script>
        window.alert('Benvenuto!');
        window.location='/index.php';
        </script>";
      //  header("location: /index.php");
      } else {
        echo "Errore";
      }
    } else {
      echo "error";
    }
  }

  ?>
