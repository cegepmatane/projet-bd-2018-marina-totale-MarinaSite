<?php
include_once "baseDeDonnee.php";

class FactureDAO
{
    public function lireFacture(int $numero)
    {
        $LIRE_FACTURE = "SELECT
                   prix_electricite_par_pied_carre,
                   prix_emplacement_par_pied_carre,
                   datedebut as date_debut,
                   datefin as date_fin,
                   id_emplacement,
                   electricite,
                   essence,
                   vidange,
                   nom,
                   longueur,
                   largeur
            FROM facture as f
            LEFT JOIN \"factureReservation\" f_r on f.id = f_r.\"idFacture\"
            LEFT JOIN reservation r on f_r.\"idReservation\" = r.id
            LEFT JOIN bateau b on r.id_bateau = b.id
            WHERE f.id = :id
            LIMIT 1";

        global $basededonnees;

        $requeteLireFacture = $basededonnees->prepare($LIRE_FACTURE);

        $requeteLireFacture->bindValue(':id', $numero);

        $requeteLireFacture->execute();

        return $requeteLireFacture->fetch(PDO::FETCH_OBJ);
    }
}