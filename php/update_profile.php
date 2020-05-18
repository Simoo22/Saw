<?php
session_start();

if(!isset($_SESSION['email'])){
	header("location: /index.php");
}

// TODO: change credentials in the db/mysql_credentials.php file
$path=$_SERVER['DOCUMENT_ROOT'];
require_once($path.'/db/mysql_credentials.php');

// Open DBMS Server connection
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
// Get value from $_SESSION
$email = $_SESSION['email']; // replace null with $_SESSION

// Get values from $_POST, but do it IN A SECURE WAY
$first_name = test_input($con,$_POST['nome']); // replace null with $_POST and sanitization
$last_name = test_input($con,$_POST['cognome']); // replace null with $_POST and sanitization
$describe_user = test_input($con,$_POST['textarea']);
$user_country = test_input($con,$_POST['nazione']);
$user_address = test_input($con,$_POST['address']);
$user_gender = test_input($con,$_POST['sesso']);
$user_birthday = test_input($con,$_POST['date']);


// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingl
function test_input($con,$data) {
  $data = trim($data);
  $data = mysqli_real_escape_string($con,$data);
  return $data;
}

function update_user( $email, $first_name, $last_name, $user_birthday, $user_country,
    $user_gender, $describe_user, $user_address, $db_connection) {
  if (isset($_POST['update'])) {
    $query ="UPDATE utenti SET nome=?, cognome=?,data_nascita=?,nazione=?,
      sesso=?,descrizione=?,address=? WHERE email=?";
    $stmt = mysqli_prepare($db_connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssssss", $first_name, $last_name, $user_birthday, $user_country,
        $user_gender, $describe_user, $user_address, $email);

    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db_connection);
    return $res;
    }

    return false;
}

// Get user from login
$successful = update_user($email, $first_name, $last_name, $user_birthday, $user_country,
    $user_gender, $describe_user, $user_address, $con);

if ($successful) {
    // Success message
    header("Location: /show_profile.php");
    exit();
} else {
    $error_message =  "C'è stato un errore nel processo di aggiornamento delle informazioni.";
}
