<?php

include '../accesseur/ClientDAO.php';


require '../lib/PHPMailer-5.2-stable/PHPMailerAutoload.php';


function envoyerMailDepuisGerant($subject, $body, $id){

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

    $reservationDAO = new ReservationDAO();
    $reservation = $reservationDAO->trouverReservation($id);


    $clientDAO = new ClientDAO();
    $client = $clientDAO->trouverClientId($reservation->id_client);

    $nom = $client->nom;

    $mail->Subject = $subject;
    $mail->Body = "<html><body>Bonjour ".$nom.",<br><br> ".$body."<br><br> Au plaisir,<br> L'équipe Marina Connect";

    $adresse = $client->mail;
    $adresseGerant = $_SESSION['pseudo'];

    $mail->AddAddress($adresse);
    $mail->AddCC($adresseGerant);


    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        $mail_envoye = '0';
    } else {
        $mail_envoye =  '1';
    }

    return $mail_envoye;
}
