<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];

    include '../accesseur/ReservationDAO.php';
    include '../accesseur/BateauDAO.php';
    $reservationDAO = new ReservationDAO();
    $bateauDAO = new BateauDAO();

    $reservation = $reservationDAO->trouverReservation($id);
    $id_bateau = $reservation->id_bateau;
    $nomBateau = $bateauDAO->trouverBateau($id_bateau)->nom;
    $typeBateau = $bateauDAO->trouverBateau($id_bateau)->type_bateau;

    include 'envoyerMailDepuisGerant.php';
    $mail_envoye = envoyerMailDepuisGerant("Reservation supprimee", "Malheureusement, votre réservation du ".$reservation->datedebut. " au ". $reservation->datefin." (bateau: ".$nomBateau.", type: ".$typeBateau.") a dû être supprimée pour des raisons de logistique. Nous nous excusons! Faites une autre réservation sur notre site !", $id);

    $reservationDAO->supprimerReservation($id);

    header('Location: ../vue/partieGerant.php?success=' . $mail_envoye . '');

    exit();
}