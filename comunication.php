<?php
  function test_input($id) {
    if(is_numeric($id)) {
      return true;
    }
    return false;
  }

  if(test_input($_GET['id'])) {
  $comunicationid = $_GET['id'];
  } ?>


<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>Comunicazione</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/bootstrap/bootstrap.min.js"></script>
  </head>
  <body>
    <?php $path = $_SERVER['DOCUMENT_ROOT'];
    require_once($path."/db/mysql_credentials.php");
    include($path.'/includes/header.php');

    if($comunicationid != null) {
      $con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
      $query = "SELECT * FROM mails WHERE mailid='$comunicationid'";
      $res = mysqli_query($con,$query);
      if(mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $object = $row['oggetto'];
        $text = $row['testo'];
        $date = $row['sent_date'];
        $registeredonly = $row['registeredonly'];
        if(!$registeredonly) {
        echo "<div class='mt-4 container border border-dark rounded'>
        <div class='my-5 container' style='min-height: 300px;'>
        <h4>$object</h4>
        <hr>
        <div class='text-right text-secondary'>$date</div>
        <p style='word-wrap: break-word;'>$text</p>
        </div>
        </div> ";
      } else {
        session_start();
        if(!isset($_SESSION['email'])){
        	echo "need to login to get this email";
        } else {
          echo "<div class='mt-4 container border border-dark rounded'>
          <div class='my-5 container' style='min-height: 300px;'>
          <h4>$object</h4>
          <hr>
          <div class='text-right text-secondary'>$date</div>
          <p style='word-wrap: break-word;'>$text</p>
          </div>
          </div> ";
        }
      }
      }
    } else {
      echo "invalid id";
    }?>

    <div class="mt-5" >
      <?php include($path."/includes/footer.html"); ?>
    </div>

  </body>
</html>
