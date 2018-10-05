<?php
include_once "baseDeDonnee.php";

Class EmplacementDAO
{

    public function listerEmplacement()
    {
        $LISTER_EMPLACEMENT = "SELECT * FROM emplacement";
        global $basededonnees;
        $requeteListerEmplacement = $basededonnees->prepare($LISTER_EMPLACEMENT);
        $requeteListerEmplacement->execute();

        return $requeteListerEmplacement->fetchAll(PDO::FETCH_OBJ);
    }

    public function ajouterEmplacement(Emplacement $emplacement)
    {
        $AJOUTER_EMPLACEMENT = "INSERT INTO emplacement(longueur, largeur, estDisponible) VALUES (:longueur, :largeur; :estDisponible)";

        global $basededonnees;

        $requeteAjouterEmplacement = $basededonnees->prepare($AJOUTER_EMPLACEMENT);

        $requeteAjouterEmplacement->bindValue(':longueur', $emplacement->getLongueur());
        $requeteAjouterEmplacement->bindValue(':largeur', $emplacement->getLargeur());
        $requeteAjouterEmplacement->bindValue(':estDisponible', $emplacement->getEstdisponible());


        $requeteAjouterEmplacement->execute();
    }

    public function modifierEplacement(Emplacement $emplacement)
    {
        $MODIFIER_EMPLACEMENT = "UPDATE emplacement SET longueur = :longueur, largeur = :largeur WHERE idemplacement = :idemplacement";

        global $basededonnees;

        $requeteModifierEmplacement = $basededonnees->prepare($MODIFIER_EMPLACEMENT);

        $requeteModifierEmplacement->bindValue(':longueur', $emplacement->getLongueur());
        $requeteModifierEmplacement->bindValue(':largeur', $emplacement->getLargeur());
        $requeteModifierEmplacement->bindValue(':estDisponible', $emplacement->getEstdisponible());
        $requeteModifierEmplacement->bindValue(':idemplacement', $emplacement->getIdemplacement());

        $requeteModifierEmplacement->execute();
    }

    public function trouverEmplacement($idemplacement)
    {
        global $basededonnees;
        $TROUVER_EMPLACEMENT = 'SELECT * FROM emplacement WHERE idemplacement = :idemplacement';
        $requeteTrouverEmplacement = $basededonnees->prepare($TROUVER_EMPLACEMENT);
        $requeteTrouverEmplacement->bindValue(':idemplacement', $idemplacement);
        $requeteTrouverEmplacement->execute();

        return $requeteTrouverEmplacement->fetch(PDO::FETCH_OBJ);
    }

    public function supprimerEmplacement($idemplacement)
    {
        global $basededonnees;
        $SUPPRIMER_EMPLACEMENT = 'DELETE FROM emplacement WHERE idemplacement = :idemplacement';
        $requeteSupprimerEmplacement = $basededonnees->prepare($SUPPRIMER_EMPLACEMENT);
        $requeteSupprimerEmplacement->bindValue(':idemplacement', $idemplacement);
        $requeteSupprimerEmplacement->execute();
    }

    public function idEmplacementSelonDate($dateDebut, $dateFin)
    {
        //REQUETE DATE OVERLAPING OK

        /*$LISTER_EMPLACEMENT = "SELECT id_emplacement
                                FROM reservation 
                                WHERE :datedebut > datefin OR :datefin < datedebut";*/

        $LISTER_EMPLACEMENT = "SELECT * FROM emplacement WHERE id NOT IN 
                                (SELECT id_emplacement FROM reservation 
                                WHERE :datedebut < datefin AND :datefin > datedebut 
                                AND id_emplacement IS NOT NULL)";

        global $basededonnees;

        $requeteListerEmplacement = $basededonnees->prepare($LISTER_EMPLACEMENT);
        $requeteListerEmplacement->bindValue(':datedebut', $dateDebut);
        $requeteListerEmplacement->bindValue(':datefin', $dateFin);
        $requeteListerEmplacement->execute();

        return $requeteListerEmplacement->fetchAll(PDO::FETCH_OBJ);
    }

    public function checkTailleEmplacementSelonBateau($idbateau, $emplacement)
    {
        $LISTER_EMPLACEMENT_DISPONIBLE_SELON_BATEAU = "SELECT * FROM bateau WHERE id=:idbateau 
                                                      AND largeur < :largeurEmplacement 
                                                      AND longueur < :longueurEmplacement";

        global $basededonnees;

        $requeteListerBateauPlusPetitQueEmplacement = $basededonnees->prepare($LISTER_EMPLACEMENT_DISPONIBLE_SELON_BATEAU);
        $requeteListerBateauPlusPetitQueEmplacement->bindValue(':idbateau', $idbateau);
        $requeteListerBateauPlusPetitQueEmplacement->bindValue(':largeurEmplacement', $emplacement->largeur);
        $requeteListerBateauPlusPetitQueEmplacement->bindValue(':longueurEmplacement', $emplacement->longueur);
        $requeteListerBateauPlusPetitQueEmplacement->execute();

        $res = $requeteListerBateauPlusPetitQueEmplacement->fetch(PDO::FETCH_OBJ);

        if($res !== false) {
            return true;
        }
        return false;
    }
}