<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require_once($path."/php/mailer.php");
require_once($path."/db/mysql_credentials.php");

$mail->From = "sitoweb@gmail.com";
$mail->FromName = "Raffreddatore2000";

$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

if($_POST['usehtml'] == true) {
  $usehtml = true;
} else {
  $usehtml = false;
}
$subject=$_POST['emailobject'];
$text = $_POST['emailtext'];
$sendtoRegistered = $_POST['sendto'];

$query = "SELECT email FROM newsletter WHERE verified=1";
if($sendtoRegistered) {
  $query = $query."&& registered=1";
}

$res = mysqli_query($con, $query);
$numrows = mysqli_num_rows($res);

$emailsent = 0;
while($row =  mysqli_fetch_assoc($res)) {
$mail->addAddress($row['email']);
$mail->isHTML($usehtml);

$mail->Subject = $subject;
$mail->Body = $text;
$mail->AltBody = "This is the plain text version of the email content";
if($mail->send()) {
  $emailsent = $emailsent + 1;
}

}

if($emailsent != $numrows) {
  echo "error";
} else {
  $query = "INSERT INTO mails(oggetto,testo,registeredonly) VALUES('$subject','$text',$sendtoRegistered)";
  echo $query;
  $res = mysqli_query($con, $query);
  if(mysqli_affected_rows($con) == 1) {
    echo "fatto";
 } else {
   echo "erroe nel regi";
 }
}

 ?>
