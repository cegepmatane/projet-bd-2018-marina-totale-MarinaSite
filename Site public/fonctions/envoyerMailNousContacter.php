<?php

require '../lib/PHPMailer-5.2-stable/PHPMailerAutoload.php';


function envoyerMailNousContacter($nom, $email, $body){

    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    //$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "aherkens@gmail.com";
    $mail->Password = "sportextreme";
    $mail->SetFrom("marinaconnect@gmail.com");

    $mail->Subject = "Commentaire laissé par un utilisateur";
    $mail->Body = $nom. " (" . $email . ") a laissé le message suivant : " . $body;

    $mail->AddAddress("florent.fli@gmail.com");
    $mail->AddAddress($email);


    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        $mail_envoye = '0';
    } else {
        $mail_envoye =  '1';
    }

    return $mail_envoye;

}
