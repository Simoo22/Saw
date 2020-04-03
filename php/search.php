<?php

// TODO: change credentials in the db/mysql_credentials.php file
$path = $_SERVER['DOCUMENT_ROOT'];
require_once($path.'/db/mysql_credentials.php');

// Open DBMS Server connection
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db);


function test_input($con,$data) {
  $data = trim($data);
  $data = mysqli_real_escape_string($con,$data);
  return $data;
}

$search = test_input($con, $_GET['string']);
// Get search string from $_GET['search']
// but do it IN A SECURE WAY

function search($search, $db_connection) {
  $query = "SELECT * FROM mails WHERE oggetto LIKE ? or testo LIKE ?";
  $stmt = $db_connection->prepare($query);
  $string = '%'.$search.'%';
  $stmt->bind_param('ss', $string, $string);
  $stmt->execute();

  $result = $stmt->get_result();
  $array = $result->fetch_all(MYSQLI_ASSOC);

  // Return array of results
  return $array;
}

// Search on database
$results = search($search, $con);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/bootstrap/bootstrap.min.js"></script>
  </head>
  <body>

    <?php require_once($path."/php/header.php"); ?>

    <div class='container mt-4 container border border-dark rounded'>
      <div class='my-5 container'>
        <a href="/comunication.php?id="></a>
  <?php
    if ($results) {
      foreach ($results as $result) {
        $object = $result['oggetto'];
        $text = $result['testo'];
        $mailid = $result['mailid'];
        // Format as you like and print search results
        echo "
            <a href='/comunication.php?id=$mailid' class='font-weight-bold text-uppercase text-dark' style='text-decoration: none;'>$object</a>
            <br>
            $text
            <br> <hr>";
      }
    } else {
      // No matches found
      echo "No results found";
    }
  ?>
</div>
</div>
  </body>
</html>
