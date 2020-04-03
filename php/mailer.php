<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path."/vendor/autoload.php";

$mail = new PHPMailer\PHPMailer\PHPMailer();

//Enable SMTP debugging.
$mail->SMTPDebug = 3;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "simonecarusoprogettosaw@gmail.com";
$mail->Password = "Secret64";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";
//Set TCP port to connect to
$mail->Port = 587;

?>
