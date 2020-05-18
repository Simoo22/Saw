<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <title>Chi siamo</title>
    <meta charset="UTF-8">
    <meta content="author" name="Caruso Simone">
    <meta content="keywords" name="auto raffreddamento">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/bootstrap/bootstrap.min.js"></script>
    <style media="screen">
    .page-header {
      position: relative;
      height: 50vh;
      background-size: cover;
      margin: 0;
      padding: 0;
      border: 0;
      align-items: center;
    }
    .bottom {
      position: absolute;
      width: 50%;
      bottom: 0;
    }
    </style>
  </head>
  <body>
    <?php $path = $_SERVER['DOCUMENT_ROOT'];
    include($path."/includes/header.php"); ?>
    <div class="page-header" data-parallax="true" style="background-image: url('/images/about_us_background.png');">
      <div class="ml-5 bottom" style="  ">
        <h3 style="color: white;">About us</h5></div>
      </div>

      <div class="container my-4">
        <div class="">
          <p>Siamo una società che lavora dalla sua fondazione in sistemi di raffreddamento per aziende terze. <br>
            Ad oggi stiamo sviluppando questa nuova idea. </p>
        </div>
        <ul>
          <li><a href="#">Facebook</a></li>
        </ul>
      </div>
      <br>
      <br>
      <br>
    <?php include($path."/includes/footer.html") ?>
  </body>
</html>
