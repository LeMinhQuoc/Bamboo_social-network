<?php

//Include required PHPMailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../php/database/database.php';

$id = $_GET["id"];

//Create instance of PHPMailer
$mail = new PHPMailer();
//Set mailer to use smtp
$mail->isSMTP();
//Define smtp host
$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
$mail->SMTPSecure = "tls";
//Port to connect smtp
$mail->Port = "587";
//Set gmail username
$mail->Username = "minhquoc7a3a@gmail.com";
//Set gmail password
$mail->Password = "01694844753";
//Email subject
$mail->Subject = "Sign in report!";
//Set sender email
$mail->setFrom('minhquoc7a3a@gmail.com');
//Enable HTML
$mail->isHTML(true);
//Attachment
// $mail->addAttachment('img/attachment.png');
//Email body
$mail->Body = "<h1>Your Information</h1></br><p> You have been Sign in by " . $id . "  </p><p>    example.com</p>";
//Add recipient
$mail->addAddress($id);
//Finally send email
if ($mail->send()) {
	echo "Email Sent..!";
	header("location:../index.php");
} else {
	echo "Message could not be sent. Mailer Error: "{
	$mail->ErrorInfo};
}
//Closing smtp connection
$mail->smtpClose();
