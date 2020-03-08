<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
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

</body>
</html>




<?php

session_start();

$path = $_SERVER["DOCUMENT_ROOT"];
require_once($path."/db/mysql_credentials.php");

mysqli_report(MYSQLI_REPORT_STRICT);
// Add session control, header, ...
// Open DBMS Server connection
function connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db) {
  try {
    $mysqli = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);
    return $mysqli;
  } catch (mysqli_sql_exception $e) {
    throw new Exception('Failed to connect to MySQL');
  }
}

function is_valid_email($email, $db_connection) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
  }
  $query = "SELECT Email FROM utenti WHERE Email = '$email'";
  $res = mysqli_query($db_connection, $query);
  if(mysqli_num_rows($res) == 1) {
    return true;
  } else {
    return false;
  }
}

function login($email, $pass, $db_connection) {
  // TODO: login logic here
  $query = "SELECT Nome, Cognome FROM utenti WHERE Email = ? and Password = ?";
  $stmt = mysqli_prepare($db_connection, $query);
  mysqli_stmt_bind_param($stmt, "ss", $email, $pass);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  
  if(mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_bind_result($stmt, $name, $lastname);
    mysqli_stmt_fetch($stmt);
    $res = $name." ".$lastname;

    mysqli_stmt_close($stmt);
    mysqli_close($db_connection);

    return $res;
  } else {
    return false;
  }
}

try {
  $con = connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
  if(isset($_POST['email']) && isset($_POST['pass'])) {
    if(is_valid_email($_POST['email'], $con)) {
      $email = $_POST['email'];
    } else {
      throw new Exception("Email non valida.");
    }
    $pass = hash("md5" ,  $_POST['pass'] );
    // Get user from login
    $user = login($email, $pass, $con);
  } else {
    throw new Exception("Something was empty in the login form.");
  }
} catch(Exception $e) {
  echo $e -> getMessage();
}


if ($user) {
  // Welcome message
  echo "Welcome $user!";
} else {
  // Error message
  echo "Wrong email or password";
}

?>
