<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
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
      <div class="border border-dark ">
        <div class="container my-2">
          <h5>Inserisci la password qui sotto per reimpostarla</h5>
          <div class="container">
          <form class="" action="/php/gestione_account/change_pass_confirm.php<<?php if (!preg_match('/[^A-Za-z0-9]/', $_GET['user'])) echo $_POST['user']; ?>" method="post">
            <div class="form-group ml-5">
  						<label for="pass" class="col-sm-10 col-form-label text-muted">Password</label>
  						<div class="col-sm-10">
  							<input class="form-control text-dark" type="password" name="pass" required>
  						</div>
  						<label for="pass_confirm" class="col-sm-10 col-form-label text-muted">Conferma password</label>
  						<div class="col-sm-10">
  							<input class="form-control text-dark" type="password" name="pass_confirm" required>
  						</div>
              <div class="text-right my-2">
    						<button class="redbutton" type="submit" name="update">Conferma</button>
              </div>
          </form>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
