
<!DOCTYPE html>
<html>
<head>
  <title>Climatizzatore Auto</title>
  <meta charset="UTF-8">
  <meta content="author" name="Caruso Simone">
  <meta content="keywords" name="auto raffreddamento">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="/js/bootstrap/bootstrap.min.js"></script>
  <style media="screen">
  div.background {
    background: url('/images/index_background.png');
    position: relative;
    background-size: cover;
    height: 70vh;
    margin: 0;
    padding: 0;
    border: 0;
    align-items: center;
  }

  h1{
    font-style: italic;
    font-weight: 900;
    font-size: 70px;
    line-height: 100px;
  }

  .botoftitle{
    font-weight: 700;
    font-size: 18px;
    line-height: 20px;
  }
  </style>
</head>
<body>

  <?php
  $path = $_SERVER['DOCUMENT_ROOT'];
  include($path."/includes/header.php");
  ?>
  <div class="background mb-5">
        <div class="container"> <br>
            <div class="row mx-3">
              <div >
                <h1>CLIMATIZZATORE AUTO INTELLIGENTE</h1>
                <hr class="my-4">
                <p class="botoftitle">Il nostro impianto renderà la tua auto intelligente e ti permetterà un comfort assoluto</p>
                <a class="btn big-redbutton btn-lg ml-5" href="/funzionamento.php" role="button">Leggi di più!</a>
              </div>
          </div>
        </div>
        <br>
      </div>

  <div class="row container mx-auto my-5">
    <div class="">
      <img src="/images/smartheatpump.png" class=" img-fluid rounded" style="height: 200px;" alt="Funzionamento pompa di calore">
      <figcaption style="text-align: center;"><a href="funzionamento.php">Come funziona</a></figcaption>
    </div>
    <div class="mx-5" style="border-left: 1px solid gray; height: 180px;"></div>
    <div class="">
      <img src="/images/industry.png" class=" img-fluid rounded" style="height: 200px;" alt="Funzionamento pompa di calore">
      <figcaption style="text-align: center;"><a href="/chi_siamo.php">About us</a></figcaption>
    </div>
    <div class="mx-5" style="border-left: 1px solid gray; height: 180px;"></div>
    <div class="">
      <img src="/images/ecologic.png" style="height:200px; weight: 190px;" alt="">
      <figcaption style="text-align: center; color: grey;">Noi rispettiamo l'ambiente</figcaption>
    </div>
  </div>

  <div class="container my-5">
    <div class="row">
      <div class="mr-5<">
        <h4 class="ml-4">Ultimi  aggiornamenti: </h4>
        <ul class="ml-4">
          <?php
          require_once($path."/db/mysql_credentials.php");
          $con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
          $query = "SELECT * FROM mails WHERE registeredonly=0 ORDER BY mailid DESC LIMIT 5";
          $res = mysqli_query($con, $query);
          while($row = mysqli_fetch_array($res))
            echo "<li><a class='text-dark' style='text-transform: uppercase;' href='/comunication.php?id=".$row['mailid']."'>".$row['oggetto']."</a></li>";
          ?>
        </ul>
      </div>
    </div>
  </div>


    <div class="mt-5" >
      <?php include($path."/includes/footer.html"); ?>
    </div>


<script>
  <?php if(isset($_SESSION['email']))
          echo "var hideElemnt = document.getElementById('singupDiv');
          hideElemnt.style.display = 'none';"
          ?>
</script>

  </body>
  </html>
