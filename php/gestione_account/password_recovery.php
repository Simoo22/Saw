<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Recupera password</title>
    <meta charset="UTF-8">
    <meta content="author" name="Caruso Simone">
    <meta content="keywords" name="auto raffreddamento">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/bootstrap/bootstrap.min.js"></script>
  </head>
  <body>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    include($path."/includes/header.php");
    ?>
    <div class="d-flex justify-content-center my-5">
      <div class="border border-dark col-sm-5 ">
    <?php
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

    if(isset($_POST['submit'])) {
      $con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
      if(is_valid_email($_POST['email'],$con) {
      $email = $_POST['email'];
      $path = $_SERVER['DOCUMENT_ROOT'];
      include($path."/php/mailer.php");
      $token = "FgUftoQCvdewDXCDOhCBX5oeR1kxBj";
      $key = md5($email.$token);
      $mail->From = "no-replay@gmail.com";
      $mail->FromName = "no-replay";
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = "RECUPERA PASSWORD";
      $mail->Body = "<h1>Richiesta modifica password</h1>
      <p>Per reimpostare la tua password clicca il seguente link e segui le istruzioni. </p> <br>
      <p>  https://a9112262.ngrok.io/php/gestione_account/change_pass.php?user=$key </p> <br>
      <p> Se non sei stato tu a richiedere di modificare la password, ignora semplicemente questa mail. </p>";
      $mail->AltBody = "This is the plain text version of the email content";
      if($mail->send())  {
        echo "<div class='my-3'> <p>Email di recupero password inviata all'indirizzo ".$email."</p></div>";
      }
    } else {
      echo "email non valida";
    }
  } else {
    header("Location: /index.php");
  }
    ?>
  </div>
</div>
  </body>
</html>
