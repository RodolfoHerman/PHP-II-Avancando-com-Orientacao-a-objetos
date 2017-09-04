<?php

require_once('vendor/phpmailer/PHPMailer.php');
require_once('vendor/phpmailer/src/SMTP.php');
require_once('vendor/phpmailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;

session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$msg = $_POST['msg'];

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
//Conta gmail para utilizar o servidor de email
$mail->Username = "seuemail@gmail.com";
$mail->Password = "suasenha";
//Quem esta enviando o e-mail
$mail->setFrom("seuemail@gmail.com", "Teste envio de e-mail com PHPMailer");
//Quem esta recebendo o e-mail
$mail->addAddress("h-e-r-m-a-n@hotmail.com");

$mail->isHTML(true);

$mail->Subject = "E-mail de contato da loja";
$mail->Body = "<html>de: {$nome}<br/>email: {$email}<br/>mensagem: {$msg}</html>";
$mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$msg}";

if($mail->send()) {

	$_SESSION['success'] = "Mensagem enviada com sucesso.";
	header("Location: index.php");

} else {

	$_SESSION['danger'] = "Falha ao enviar a mensagem!!  " . $mail->ErrorInfo;
	header("Location: contato.php");

}

die();