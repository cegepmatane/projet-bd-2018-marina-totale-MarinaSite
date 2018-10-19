<?php

require 'lib/PHPMailer-5.2-stable/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'aherkens@gmail.com';                 // SMTP username
$mail->Password = 'sportextreme';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to
$mail->From = 'aherkens@gmail.com';
$mail->setFrom('aherkens@gmail.com', 'Mailer');
$mail->addAddress('aherkens@gmail.com', 'destinataire');     // Add a recipient


$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}


/*$message = "Salut";

mail('aherkens@yahoo.fr', "Test", $message);*/

/*$to      = 'aherkens@yahoo.fr';
$subject = 'the subject';
$message = 'hello';
$headers = array(
    'From' => 'webmaster@example.com',
    'Reply-To' => 'webmaster@example.com',
    'X-Mailer' => 'PHP/' . phpversion()
);

mail($to, $subject, $message, $headers);*/

/*
$to = "aherkens@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "aherkens@gmail.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";


$to = "aherkens@gmail.com";
$subject = "ça marche";

$message = "coucou";
// Always set content-type when sending HTML
$headers = 'From: <aherkens@yahoo.fr>'  . " " .
// 'Reply-To: user@yourdomain.com' . " " .
    'X-Mailer: PHP/' . phpversion();
echo "ça charge";
if(mail($to,$subject,$message,$headers)){
    mail($to,$subject,$message,$headers);

    echo"ça marche";
}else{
    echo"ça marche pas, triste";
}
*/