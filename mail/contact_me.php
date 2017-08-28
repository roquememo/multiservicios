<?php
date_default_timezone_set('Etc/UTC');

require '../PHPMailer/PHPMailerAutoload.php';

if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

   	$name = $_POST['name'];
	$email_address = $_POST['email'];
	$message = $_POST['message'];

   	$email_subject1 = "Soporte de contacto: ";
			
	$email_body1 = "<p>Ha sido contactado por: <b>".$name."</b>, Su mensaje es el siguiente.</p>
							<p>-----------------------------------</p>
							<p>".preg_replace("/[\r\n]/i", "<br />", $message)."</p>
							<p>-----------------------------------</p>
							<p>
								Ponte en contacto, Email: <a href=\"mailto:".$email_address."\">".$email_address."</a>
							</p>";

	$email_subject2 = "Confirmacion de envio: ";
			
	$email_body2 = "<p>Hola <b>".$name."</b> Gracias por escribirnos, Su mensaje:</p>
							<p>-----------------------------------</p>
							<p>".preg_replace("/[\r\n]/i", "<br />", $message)."</p>
							<p>-----------------------------------</p>
							<p>
							Se ha enviado con éxito, Dentro de unos instantes uno de nuestros colaboradores se pondrá en contacto con usted.
							</p>";
	

$mail=new PHPMailer();
$mail2=new PHPMailer();

$mail->isSMTP();
$mail2->isSMTP();

$mail->SMTPDebug = 0;
$mail2->SMTPDebug = 0;

$mail->Debugoutput = 'html';
$mail2->Debugoutput = 'html';

$mail->Host = 'smtp.gmail.com';
$mail2->Host = 'smtp.gmail.com';

$mail->Port = 587;
$mail2->Port = 587;

$mail->SMTPSecure = 'tls';
$mail2->SMTPSecure = 'tls';

$mail->SMTPAuth = true;
$mail2->SMTPAuth = true;

$mail->Username = "multiservicioscasko@gmail.com";
$mail2->Username = "multiservicioscasko@gmail.com";

$mail->Password = "Admin.12345";
$mail2->Password = "Admin.12345";

$mail->setFrom('multiservicioscasko@gmail.com', 'Multiservicios Casko');
$mail2->setFrom('multiservicioscasko@gmail.com', 'Multiservicios Casko');

$mail->addAddress('roquememo@hotmail.com', 'Administrador');
$mail2->addAddress($email_address, $name);

$mail->Subject = $email_subject1;
$mail->MsgHTML($email_body1);

$mail2->Subject = $email_subject2;
$mail2->MsgHTML($email_body2);

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message enviado!";
}

if (!$mail2->send()) {
    echo "Mailer Error: " . $mail2->ErrorInfo;
} else {
    echo "Message enviado!";
}




		
?>