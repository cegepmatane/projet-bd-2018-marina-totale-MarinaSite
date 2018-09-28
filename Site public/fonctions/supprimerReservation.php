<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];

    include '../accesseur/ReservationDAO.php';
    $reservationDAO = new ReservationDAO();
    $reservationDAO->supprimerReservation($id);

    header('Location: ../vue/partieGerant.php');
    exit();
}