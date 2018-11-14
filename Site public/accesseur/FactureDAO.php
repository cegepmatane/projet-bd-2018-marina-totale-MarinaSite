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
                   b.nom as nom_bateau,
                   e.longueur as longueur_emplacement,
                   e.largeur as largeur_emplacement,
                   c.nom as nom_client,
                   c.prenom as prenom_client,
                   r.id_client,
                   f.id as id_facture,
                   date_creation
            FROM \"factureReservation\" f_r
            LEFT JOIN facture f on f_r.\"idFacture\" = f.id
            LEFT JOIN reservation r on f_r.\"idReservation\" = r.id
            LEFT JOIN emplacement e on r.id_emplacement = e.id
            LEFT JOIN bateau b on r.id_bateau = b.id
            LEFT JOIN client c on r.id_client = c.id
            WHERE r.id = :id
            LIMIT 1";

        global $basededonnees;

        $requeteLireFacture = $basededonnees->prepare($LIRE_FACTURE);

        $requeteLireFacture->bindValue(':id', $numero);

        $requeteLireFacture->execute();

        return $requeteLireFacture->fetch(PDO::FETCH_OBJ);
    }
}