<?php

ob_start();



if(isset($_POST['btnSubmit']))
{
require("class.phpmailer.php");



$mail = new PHPMailer();

//Your SMTP servers details

$mail->IsSMTP();               // set mailer to use SMTP
$mail->Host = "smtp.gmail.com";  // specify main and backup server or localhost
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->SMTPSecure = "tls"; 
$mail->SMTPDebug = 1; // can vary the amount of debug info given on error
$mail->Username = "mail@mydomain.com";  // SMTP username
$mail->Password = "########"; // SMTP password
$mail->Port = 587;


$redirect_url = "http://www.mydomain.com/contact/contact_success.php"; //Redirect URL after submit the form

$mail->From = $mail->Username;  //Default From email same as smtp user
$mail->FromName = "Website Contact Form";

$mail->AddAddress("mail@mydomain.com", "From Contact Form"); //Email address where you wish to receive/collect those emails.

$mail->WordWrap = 50;                                 // set word wrap to 50 characters
$mail->IsHTML(true);                                  // set email format to HTML



$mail->Subject = "From Contact Form";
$message = "FullName: ".htmlspecialchars($_POST['fullname'])." <br> <br> 
\r\n <br>EmailAddress: ".htmlspecialchars($_POST['email'])." <br> <br> 
\r\n <br>Phone Number: ".htmlspecialchars($_POST['mobile'])."  <br> <br> 
\r\n <br> Message: <br>".htmlspecialchars($_POST['message']);
$mail->Body    = $message;

if(!$mail->Send())
{
   echo "Sorry the message could not be sent. Please email mail@mydomain.com instead. Thanks<p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent";
header("Location: $redirect_url");
}
?>