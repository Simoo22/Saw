<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Loin -</title>
  <meta content="author" name="Caruso Simone">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
</head>
<body>

  <?php


  session_start();
  $path = $_SERVER['DOCUMENT_ROOT'];
  include($path."/php/header.php");
  require_once($path."/db/mysql_credentials.php");

  // Add session control, header, ...
  // Open DBMS Server connection


  function is_valid_email($email, $db_connection) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
    }
      return true;
  }

  function login($email, $pass, $db_connection) {
    // TODO: login logic here
    $query = "SELECT * FROM utenti WHERE Email = ? and Password = ?";
    $stmt = mysqli_prepare($db_connection, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $pass);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) == 1) {
      mysqli_stmt_close($stmt);
      mysqli_close($db_connection);
      return true;
    } else {
      return false;
    }
  }


  $con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);
  if($con) {
    if(isset($_POST['email']) && isset($_POST['pass'])) {
      if(is_valid_email($_POST['email'], $con)) {
        $email = $_POST['email'];
        $pass = hash("md5" ,  $_POST['pass'] );
        // Get user from login
        $user = login($email, $pass, $con);

        if ($user) {
          $_SESSION['email'] = "$email";
          header("location: /index.php");
        } else {
          // Error message
          echo "Wrong email or password";
        }
      } else {
        echo "Email non valida";
      }
    } else {
      echo "Email e password sono richiesti.";
    }
  } else {
    echo "Server error";
  }

  ?>

</body>
</html>
