<?php
require_once HELPERDIR . "phpmailer/class.phpmailer.php";
global $mail;
$mail = new PHPMailer();
//porta
$mail->IsSMTP();
$mail->SMTPAuth = true;
/*
$mail->Port = 25;
$mail->Host = "mail.clareslab.com.br";
$mail->Username = "teste@clareslab.com.br";
$mail->Password = "";
$mail->From = "teste@clareslab.com.br";
$mail->FromName = "Sistema";
*/
$mail->WordWrap = 80;
$mail->IsHTML( true );
?>