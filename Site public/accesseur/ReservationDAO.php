<?php
include_once "baseDeDonnee.php";

Class ReservationDAO
{

    public function listerReservationId($id)
    {
        $LISTER_RESERVATION = "SELECT * FROM reservation WHERE id_client = :id ";
        global $basededonnees;
        $requeteListerReservation = $basededonnees->prepare($LISTER_RESERVATION);
        $requeteListerReservation->bindValue(':id', $id);
        $requeteListerReservation->execute();

        return $requeteListerReservation->fetchAll(PDO::FETCH_OBJ);
    }


    public function listerReservation()
    {
        $LISTER_RESERVATION = "SELECT * FROM reservation";
        global $basededonnees;
        $requeteListerReservation = $basededonnees->prepare($LISTER_RESERVATION);
        $requeteListerReservation->execute();

        return $requeteListerReservation->fetchAll(PDO::FETCH_OBJ);
    }


    public function listerReservationEnCours()
    {
        $LISTER_RESERVATION = "SELECT * FROM reservation WHERE datefin >= current_date ";
        global $basededonnees;
        $requeteListerReservation = $basededonnees->prepare($LISTER_RESERVATION);
        $requeteListerReservation->execute();

        return $requeteListerReservation->fetchAll(PDO::FETCH_OBJ);
    }

    public function listerReservationArchivees()
    {
        $LISTER_RESERVATION = "SELECT * FROM reservation WHERE datefin < current_date ";
        global $basededonnees;
        $requeteListerReservation = $basededonnees->prepare($LISTER_RESERVATION);
        $requeteListerReservation->execute();

        return $requeteListerReservation->fetchAll(PDO::FETCH_OBJ);
    }


    public function ajouterReservation(Reservation $reservation)
    {
        $AJOUTER_RESERVATION = "INSERT INTO reservation(datedebut, datefin, id_client, id_bateau,id_service, id_emplacement) VALUES (:datedebut, :datefin, :id_client ,:id_bateau, :id_service, :id_emplacement)";

        global $basededonnees;

        $requeteAjouterReservation = $basededonnees->prepare($AJOUTER_RESERVATION);

        $requeteAjouterReservation->bindValue(':datedebut', $reservation->getDatedebut());
        $requeteAjouterReservation->bindValue(':datefin', $reservation->getDatefin());
        $requeteAjouterReservation->bindValue(':id_client', $reservation->getIdclient());
        $requeteAjouterReservation->bindValue(':id_bateau', $reservation->getIdbateau());
        $requeteAjouterReservation->bindValue(':id_service', $reservation->getIdservice());
        $requeteAjouterReservation->bindValue(':id_emplacement', $reservation->getIdemplacement());

        $requeteAjouterReservation->execute();
    }

    public function modifierReservation(Reservation $reservation, $idreservation)
    {
        $MODIFIER_RESERVATION = "UPDATE reservation SET datedebut = :datedebut, datefin = :datefin, id_service = :id_service WHERE id = :idreservation";

        global $basededonnees;

        $requeteModifierReservation = $basededonnees->prepare($MODIFIER_RESERVATION);

        $requeteModifierReservation->bindValue(':datedebut', $reservation->getDatedebut());
        $requeteModifierReservation->bindValue(':datefin', $reservation->getDatefin());
        $requeteModifierReservation->bindValue(':idreservation', $idreservation);

        $requeteModifierReservation->execute();
    }

    public function trouverReservation($idreservation)
    {
        global $basededonnees;
        $TROUVER_RESERVATION = 'SELECT * FROM reservation WHERE id = :idreservation';
        $requeteTrouverReservation = $basededonnees->prepare($TROUVER_RESERVATION);
        $requeteTrouverReservation->bindValue(':idreservation', $idreservation);
        $requeteTrouverReservation->execute();

        return $requeteTrouverReservation->fetch(PDO::FETCH_OBJ);
    }

    public function supprimerReservation($idreservation)
    {
        global $basededonnees;
        $SUPPRIMER_RESERVATION = 'DELETE FROM reservation WHERE id = :idreservation';
        $requeteSupprimerReservation = $basededonnees->prepare($SUPPRIMER_RESERVATION);
        $requeteSupprimerReservation->bindValue(':idreservation', $idreservation);
        $requeteSupprimerReservation->execute();
    }

}