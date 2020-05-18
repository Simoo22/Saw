<!DOCTYPE html>
<html lang="it" dir="ltr">
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
        <div class="my-2">
          <h5>Inserisci qui sotto la tua mail</h5>
          <p>Ti verranno inviate per email le istruzioni per inserire una nuova password.</p>
          <form class="" action="/php/gestione_account/password_recovery.php" method="post">
            <label for="email">Email</label>
            <input type="email" class="col-5" name="email" placeholder="esempio@gmail.com" required>
            <input type="submit" class="" name="submit" value="Invio">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
