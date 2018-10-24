<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];

    include '../accesseur/ReservationDAO.php';
    $reservationDAO = new ReservationDAO();

    include 'envoyerMailDepuisGerant.php';
    $mail_envoye = envoyerMailDepuisGerant("Reservation supprimee", "Malheureusement, votre réservation a dû être supprimée pour des raisons de logistique. Nous nous excusons! Faites une autre réservation sur notre site !", $id);

    $reservationDAO->supprimerReservation($id);

    header('Location: ../vue/partieGerant.php?success=' . $mail_envoye . '');

    exit();
}