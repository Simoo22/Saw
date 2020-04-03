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
$user_city = test_input($con,$_POST['comune']);
$user_province = test_input($con,$_POST['provincia']);
$user_CAP = test_input($con,$_POST['CAP']);
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
    $user_gender, $describe_user, $user_address, $user_city, $user_province, $user_CAP, $db_connection) {
  if (isset($_POST['update'])) {
    $query ="UPDATE utenti SET nome=?,
      cognome=?,data_nascita=?,nazione=?,
      sesso=?,descrizione=?,address=?,
      comune=?,provincia=?,CAP=? WHERE email=?";
    $stmt = mysqli_prepare($db_connection, $query);
    mysqli_stmt_bind_param($stmt, "sssssssssis", $first_name, $last_name, $user_birthday, $user_country,
        $user_gender, $describe_user, $user_address, $user_city, $user_province, $user_CAP, $email);

    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db_connection);
    return $res;
    }

    return false;
}

// Get user from login
$successful = update_user($email, $first_name, $last_name, $user_birthday, $user_country,
    $user_gender, $describe_user, $user_address, $user_city, $user_province, $user_CAP, $con);

if ($successful) {
    // Success message
    header("Location: /show_profile.php");
    exit();
} else {
    // Error message
    echo "There was an error in the update process.";
}
