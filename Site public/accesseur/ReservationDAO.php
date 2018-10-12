<?php
include_once "baseDeDonnee.php";

Class ReservationDAO
{

    public function listerReservationId($id)
    {
        $LISTER_RESERVATION = "SELECT * FROM reservation WHERE id_client = :id ORDER BY datedebut";
        global $basededonnees;
        $requeteListerReservation = $basededonnees->prepare($LISTER_RESERVATION);
        $requeteListerReservation->bindValue(':id', $id);
        $requeteListerReservation->execute();

        return $requeteListerReservation->fetchAll(PDO::FETCH_OBJ);
    }


    public function listerReservation()
    {
        $LISTER_RESERVATION = "SELECT * FROM reservation ORDER BY datedebut";
        global $basededonnees;
        $requeteListerReservation = $basededonnees->prepare($LISTER_RESERVATION);
        $requeteListerReservation->execute();

        return $requeteListerReservation->fetchAll(PDO::FETCH_OBJ);
    }


    public function listerReservationEnCours()
    {
        $LISTER_RESERVATION = "SELECT * FROM reservation WHERE datefin >= current_date ORDER BY datedebut ";
        global $basededonnees;
        $requeteListerReservation = $basededonnees->prepare($LISTER_RESERVATION);
        $requeteListerReservation->execute();

        return $requeteListerReservation->fetchAll(PDO::FETCH_OBJ);
    }

    public function listerReservationArchivees()
    {
        $LISTER_RESERVATION = "SELECT * FROM reservation WHERE datefin < current_date ORDER BY datedebut";
        global $basededonnees;
        $requeteListerReservation = $basededonnees->prepare($LISTER_RESERVATION);
        $requeteListerReservation->execute();

        return $requeteListerReservation->fetchAll(PDO::FETCH_OBJ);
    }


    public function ajouterReservation(Reservation $reservation)
    {
        $AJOUTER_RESERVATION = "INSERT INTO reservation(datedebut, datefin, id_client, id_bateau, id_emplacement, electricite, essence, vidange) 
                                VALUES (:datedebut, :datefin, :id_client ,:id_bateau, :id_emplacement,:electricite, :essence, :vidange)";

        global $basededonnees;

        $requeteAjouterReservation = $basededonnees->prepare($AJOUTER_RESERVATION);

        $requeteAjouterReservation->bindValue(':datedebut', $reservation->getDatedebut());
        $requeteAjouterReservation->bindValue(':datefin', $reservation->getDatefin());
        $requeteAjouterReservation->bindValue(':id_client', $reservation->getIdclient());
        $requeteAjouterReservation->bindValue(':id_bateau', $reservation->getIdbateau());
        $requeteAjouterReservation->bindValue(':id_emplacement', $reservation->getIdemplacement());
        $requeteAjouterReservation->bindValue(':essence', $reservation->getEssence());
        $requeteAjouterReservation->bindValue(':electricite', $reservation->getElectricite());
        $requeteAjouterReservation->bindValue(':vidange', $reservation->getVidange());

        $requeteAjouterReservation->execute();
    }

    public function modifierReservation(Reservation $reservation, $idreservation)
    {
        $MODIFIER_RESERVATION = "UPDATE reservation SET datedebut = :datedebut, datefin = :datefin, electricite = :electricite, vidange = :vidange, essence = :essence WHERE id = :idreservation";

        global $basededonnees;

        $requeteModifierReservation = $basededonnees->prepare($MODIFIER_RESERVATION);

        $requeteModifierReservation->bindValue(':datedebut', $reservation->getDatedebut());
        $requeteModifierReservation->bindValue(':datefin', $reservation->getDatefin());
        $requeteModifierReservation->bindValue(':essence', $reservation->getEssence());
        $requeteModifierReservation->bindValue(':electricite', $reservation->getElectricite());
        $requeteModifierReservation->bindValue(':vidange', $reservation->getVidange());
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