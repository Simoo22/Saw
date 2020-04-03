<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require_once($path."/db/mysql_credentials.php");

$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

function is_valid_email($email, $db_connection) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
  }
  $query = "SELECT Email FROM newsletter WHERE Email = '$email'";
  $res = mysqli_query($db_connection, $query);
  if(mysqli_num_rows($res) > 0) {
    return false;
  }
  return true;
}

function is_registered($email, $db_connection) {
  $query = "SELECT Email FROM utenti WHERE Email = ?";
  $res = mysqli_query($db_connection, $query);
  $stmt = mysqli_prepare($db_connection, $query);
  mysqli_stmt_bind_param($stmt, "s", $email);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  if(mysqli_stmt_num_rows($stmt) == 1) {
    mysqli_stmt_close($stmt);
    return 1;
  }  else {
    return 0;
  }
}

function insert_email($email, $db_connection) {
  //registration logic here
  $is_registered = is_registered($email,$db_connection);
  $query = "INSERT INTO newsletter(email, registered) VALUES( ? , ? )";
  $stmt = mysqli_prepare($db_connection, $query);
  mysqli_stmt_bind_param($stmt, "si", $email, $is_registered);

  $res = mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
  mysqli_close($db_connection);
  // Return if the registration was successful "md5"
  return $res;
}

if(!$con) {
  echo "Impossibile connettersi al server.";
} else {
  if(isset($_POST['sub_email'])) {
    if(is_valid_email($_POST['sub_email'], $con)) {
      $email = $_POST['sub_email'];
    } else {
      echo "email non valida";
    }
    $successful = insert_email($email, $con);
  }
}

if ($successful) {
   include($path."/php/mailer.php");
   $token = "66SLo67hpvhIsjBZORLVKMtPwI8TGHM3";
   $key = md5($email.$token);
  $mail->From = "no-replay@gmail.com";
  $mail->FromName = "no-replay";

  $mail->addAddress($email);

  $mail->isHTML(true);

  $mail->Subject = "Conferma iscrizione";
  $mail->Body = "<h1>Benvenuto!</h1>
                  <p>Grazie per esserti iscritto alla nostra newsletter, in questo modo sarai sempre aggiornato con le nostre ultime
                  novità. Per favore clicca il link qui sotto per confermare la tua identità: </p> <br>
                  <p>  https://a9112262.ngrok.io/php/attivation.php?user=$key </p> <br>
                  <p> Se non sei stato a iscriverti al nostro sito, ignora semplicemente questa mail. </p>";
  $mail->AltBody = "This is the plain text version of the email content";

  if(!$mail->send())  {
      echo "Mailer Error: " . $mail->ErrorInfo;
  }
  else  {
      echo "Message has been sent successfully";
  }
} else {
  // Error message
  echo "There was an error in the registration process.";
}


?>
