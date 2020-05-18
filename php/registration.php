<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="author" name="Caruso Simone">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
  <?php
  $path = $_SERVER['DOCUMENT_ROOT'];
  include($path."/includes/header.php");
  require_once($path."/db/mysql_credentials.php");

  mysqli_report(MYSQLI_REPORT_STRICT); //TODO check here
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

  function test_input($con,$data) {
    if(!preg_match('/^[a-z ,.\'-]+$/i', $data)) {
      return null;
    }
    $data = trim($data);
    mysqli_real_escape_string($con,$data);
    return $data;
  }


  function insert_user($email, $first_name, $last_name, $password, $password_confirm, $db_connection) {
    if($email == null || $first_name == null || $last_name == null || $password == null || $password_confirm == null) {
      echo $email.$first_name.$last_name.$password.$password_confirm;
      return false;
    }
    //check if passwords match
    if ($password != $password_confirm) {
      // error matching passwords
      return false;
    }
    //registration logic here

    $query = "INSERT INTO utenti(nome, cognome, email, password) VALUES( ? , ? , ? , ?)";
    $stmt = mysqli_prepare($db_connection, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email, $password);

    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db_connection);
    // Return if the registration was successful "md5"
    return $res;
  }

  $mailsent = false;
  $error_message = "Registrazione fallita. <br>";
  $con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
  if(!$con) {
    $error_message = $error_message."Impossibile connettersi al server. <br>";
  } else {
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email'])
            && isset($_POST['pass']) && isset($_POST['confirm'])) {
      if(is_valid_email($_POST['email'], $con)) {
        $email = $_POST['email'];
        $first_name = test_input($con,$_POST['firstname']); // replace null with $_POST and sanitization
        $last_name = test_input($con,$_POST['lastname']); // replace null with $_POST and sanitization
        $password = hash("md5" , $_POST['pass']); // replace null with $_POST and sanitization
        $password_confirm = hash("md5", $_POST['confirm']) ; // replace null with $_POST and sanitization
        // Get user from login
        $successful = insert_user($email, $first_name, $last_name, $password, $password_confirm, $con);
        echo "ciao";

        if ($successful) {
          include($path."/php/mailer.php");
          $token = "FgUftotbLBUWjwDXCDOhCBX6rb1UkxBj";
          $key = md5($email.$token);
          $mail->From = "no-replay@gmail.com";
          $mail->FromName = "no-replay";

          $mail->addAddress($email);

          $mail->isHTML(true);

          $mail->Subject = "Conferma iscrizione";
          $mail->Body = "<h1>Benvenuto!</h1>
          <p>Grazie per esserti registrato al nostro sito, in questo modo sarai sempre aggiornato con le nostre ultime
          novità. Per favore clicca il link qui sotto per confermare la tua identità: </p> <br>
          <p>  https://a9112262.ngrok.io/php/gestione_account/attivation.php?user=$key </p> <br>
          <p> Se non sei stato a iscriverti al nostro sito, ignora semplicemente questa mail. </p>";
          $mail->AltBody = "";

          if(!$mail->send())  {
            echo "Mailer Error: " . $mail->ErrorInfo;
          }
          else  {
            $mailsent = true;
            $error_message = "Registrazione avvenuta <br> Accedi alla tua casella ti posta e conferma l'iscrizione";
          }
        } else {
          $error_message = $error_message."C'è stato un errore nel processo di registrazione, riprovare. <br>";
        }
      } else {
        $error_message = $error_message."Email non valida o già registrata. <br>";
      }
    } else {
      $error_message = $error_message."Riempire tutti i campi nella registrazione. <br>";
    }
  }

  if(!$mailsent) {
    include($path."/includes/error.php");
  }  else {
    include($path."/includes/successful.php");
  }

  ?>

</body>
</html>
