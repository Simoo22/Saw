<?php

session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
require_once($path."/db/mysql_credentials.php");

function is_valid_email($email, $db_connection) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
  }
  $query = "SELECT Email FROM utenti WHERE Email = '$email'";
  $res = mysqli_query($db_connection, $query);
  if(mysqli_num_rows($res) > 0) {
    return true;
  }
  return false;
}

fuction check_input($string) {
  if (!preg_match('/[^A-Za-z0-9]/', $string)) {
    return false;
  }
  return true;
}

if(isset($_POST['submit'])) {
  $con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
  $pass = md5($_POST['pass']);
  $confirm = md5($_POST['pass_confirm']);
    if(check_input($_GET['user']) && $pass == $confirm) {
    $email = $_POST['email'];
    $key = $_GET['user'];
    if($num == 1) {
      echo "
      <script>
      alert('Password modificata con successo.');
      </script>";
      header("location: /index.php");
    $query = "UPDATE utenti SET password=$pass WHERE md5(concat(email, '$token'))='$key'";
    $res = mysqli_query($con,$query);
    $num = mysqli_affected_rows($con);

  } else {
    echo "errore scaduto";
  }
} else {
    header("Location: /index.php");
}

 ?>
