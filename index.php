
<!DOCTYPE html>
<html>
<head>
  <title>Raffreddatore2000</title>
  <meta charset="UTF-8">
  <meta content="author" name="Caruso Simone">
  <meta content="keywords" name="auto raffreddamento">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="/js/bootstrap/bootstrap.min.js"></script>
  <style media="screen">
  .Footop-newsletter {
    text-align: center;
    border-bottom: 1px solid #22252d;
    padding-bottom: 56px;
    margin-bottom: 39px;
    background-color: #282C35 !important;
    padding: 66px 0 40px;
  }

  .Footop-title {
    margin-bottom: 30px;
    padding: 0;
  }

  .Footop-title h5 {
    font-size: 20px !important;
    margin-bottom: 0;
    text-transform: uppercase !important;
    color: #adb0b6 !important;
    font-weight: 700 !important;
    letter-spacing: 1px !important;

  }

  input[type=text] {
    box-shadow: none;
    box-sizing: border-box;
    color: #9097a1;
    font-size: 12px;
    height: 40px;
    line-height: 40px;
    padding: 0 15px;
    width: 100%;
    border: 1px solid #eceef4;
    font-family: 'Open Sans', sans-serif;
    font-weight: 400;
  }
  .bgcolor {
    background-color: #c33332 !important;
  }

  .newsletterbutton {
    border: 1px solid #c33332;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    height: 47px;
    padding: 0 29px;
    text-transform: uppercase;
    background: none;
    border-radius: 4px;
    line-height: 45px;
    background-color: #c33332;
  }
</style>
</head>
<body>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/php/header.php");
?>
  <div class="jumbotron" style="background-color: #7C8EA4">
    <figure class="figure float-right">
      <img src="images/heatpump.png" class="figure-img img-fluid rounded" alt="Funzionamento pompa di calore">
      <figcaption class="figure-caption">Funzionamento pompa di calore.</figcaption>
    </figure>
    <h1 class="display-4" style="color: #D0DFF1">Raffreddatore2000</h1>
    <p class="lead">Lasciare la macchina al sole non sarà più un problema!</p>
    <hr class="my-4">
    <p>Con la nostra pompa di calore a basso consumo potrai avere sempre la tua
      temperatura ideale nella tua macchina!</p>
      <a class="btn btn-primary btn-lg" href="#" role="button">Leggi di più!</a>
    </div>
    <br>


    <div class="Footop-newsletter">
<div class="container">
	<div class="row text-center">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="Footop-title">
		    <h5>Subscribe to our Newsletter</h5>
		 </div>
     <form class="" action="/php/newsletterconfirm.php" method="post" onsubmit="return isEmailAddr();">
		 <input type="email" id="sub_email" class="form-control text-dark" name="sub_email" placeholder=" Enter Your Email Address..." required>
		<input class="newsletterbutton bgcolor mt-4" id="btn_newsletter_1" type="submit" value="Sign Up">
  </form>
		</div>
	</div>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<script>
function isEmailAddr() {
  var email = document.getElementById("sub_email").value;
  var result = false;
  var theStr = new String(email);
  var index = theStr.indexOf("@");
  if (index > 0)
  {
    var pindex = theStr.indexOf(".",index);
    if ((pindex > index+1) && (theStr.length > pindex+1))
    result = true;
  }
  return result;
}
</script>
  </body>
  </html>
