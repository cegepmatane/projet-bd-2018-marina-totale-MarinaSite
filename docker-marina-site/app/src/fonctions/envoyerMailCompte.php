<?php

require '../lib/PHPMailer-5.2-stable/PHPMailerAutoload.php';


function envoyerMail($subject, $body){

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

    $clientDAO = new ClientDAO();
    $nom = $clientDAO->trouverClientId($_SESSION['id'])->nom;

    $mail->Subject = $subject;
    $mail->Body = "<html><body>Bonjour ".$nom.",<br><br> ".$body."<br><br> <a href='http://158.69.113.110/site/vue/connexion.php'>Connectez vous à notre site</a> <br><br> Au plaisir,<br> L'équipe Marina Connect";

    $adresse = $_SESSION['pseudo'];
    $mail->AddAddress($adresse);

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        $mail_envoye = '0';
    } else {
        $mail_envoye =  '1';
    }

    return $mail_envoye;


}
