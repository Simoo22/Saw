<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once($path."/db/mysql_credentials.php");
$con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);
session_start();
if(!isset($_SESSION['email'])) {
header("location: /index.php");
}
else {
  $email = $_SESSION['email'];
  $query = "SELECT * from Utenti WHERE email ='$email'";

  $res = mysqli_query($con,$query);
  $row= mysqli_fetch_array($res);
  mysqli_free_result($res);
  $user_id = $row['id'];
  $first_name = $row['nome'];
  $last_name = $row['cognome'];
  $describe_user = $row['descrizione'];
  $user_country = $row['nazione'];
  $user_gender = $row['sesso'];
  $user_birthday = $row['data_nascita'];
  $user_image = $row['immagine_profilo'];
  $register_date = $row['reg_date'];

$target_dir = $path."/images/users/";
$imgid =  $user_id.rand(0,999999);
$target_file = $target_dir . $imgid;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    $query = "UPDATE utenti SET immagine_profilo = $imgid WHERE id=$user_id";
    echo $query;
    $res = mysqli_query($con,$query);
    $num = mysqli_affected_rows($con);
    if($num == 1) {
      header("location: /show_profile.php");
    } else {
      echo "erroe";
    }
}
}
?>
