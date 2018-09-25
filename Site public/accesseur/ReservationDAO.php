<?php
include_once "baseDeDonnee.php";

Class ReservationDAO{

    public function listerReservation(){
        $LISTER_RESERVATION = "SELECT * FROM reservation";
        global $basededonnees;
        $requeteListerReservation = $basededonnees->prepare($LISTER_RESERVATION);
        $requeteListerReservation->execute();

        return $requeteListerReservation->fetchAll(PDO::FETCH_OBJ);
    }

}