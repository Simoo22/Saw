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

$path = $_SERVER["DOCUMENT_ROOT"];
require_once($path."/db/mysql_credentials.php");

mysqli_report(MYSQLI_REPORT_STRICT);
// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingly

function is_valid_email($email, $db_connection) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
  }
  $query = "SELECT Email FROM utenti WHERE Email = '$email'";
  $res = mysqli_query($db_connection, $query);
  if(mysqli_num_rows($res) > 0) {
    return false;
  }
  return true;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db) {
   try {
      $mysqli = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);
      return $mysqli;
   } catch (mysqli_sql_exception $e) {
      throw new Exception('Failed to connect to MySQL');
   }
}


function insert_user($email, $first_name, $last_name, $password, $password_confirm, $db_connection) {

    //check if passwords match
    if ($password != $password_confirm) {
         // error matching passwords
         throw new Exception('Your passwords do not match. Please type carefully.');
     }
    //registration logic here
    $query = "INSERT INTO utenti(Nome, Cognome, Email, Password) VALUES( ? , ? , ? , ? )";
    $stmt = mysqli_prepare($db_connection, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email, $password);

    $res = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($db_connection);
    // Return if the registration was successful "md5"
    return $res;
  }

  try {
    $con = connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['confirm'])) {
      if(is_valid_email($_POST['email'], $con)) {
        $email = $_POST['email'];
      } else {
        throw new Exception("Email non valida.");
      }
      $first_name = test_input($_POST['firstname']); // replace null with $_POST and sanitization
      $last_name = test_input($_POST['lastname']); // replace null with $_POST and sanitization
      $password = hash("md5" ,  $_POST['pass'] ); // replace null with $_POST and sanitization
      $password_confirm = hash("md5",  $_POST['confirm']) ; // replace null with $_POST and sanitization

      // Get user from login
      $successful = insert_user($email, $first_name, $last_name, $password, $password_confirm, $con);
    } else {
      throw new Exception("Something was empty in the registration form.");
    }

    if ($successful) {
      // Success message
      echo "$email registered successfully!";
    } else {
      // Error message
      echo "There was an error in the registration process.";
    }
  } catch (Exception $e) {
    echo $e -> getMessage();
  }
