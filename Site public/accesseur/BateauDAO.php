<?php
include_once "baseDeDonnee.php";
Class BateauDAO
{
    public function listerBateau($id)
    {
        $LISTER_BATEAU = "SELECT * FROM bateau WHERE id_client = :id_client";
        global $basededonnees;
        $requeteListerBateau = $basededonnees->prepare($LISTER_BATEAU);
        $requeteListerBateau->bindValue(':id_client',$id);
        $requeteListerBateau->execute();

        return $requeteListerBateau->fetchAll(PDO::FETCH_OBJ);
    }

    public function ajouterBateau(Bateau $bateau)
    {
        $AJOUTER_BATEAU = "INSERT INTO bateau (nom,type_bateau, longueur, largeur, id_client) VALUES (:nom, :type_bateau, :longueur, :largeur, :id_client)";

        global $basededonnees;

        $requeteAjouterBateau = $basededonnees->prepare($AJOUTER_BATEAU);

        $requeteAjouterBateau->bindValue(':nom', $bateau->getNom());
        $requeteAjouterBateau->bindValue(':type_bateau', $bateau->getTypeBateau());
        $requeteAjouterBateau->bindValue(':longueur', $bateau->getLongueur());
        $requeteAjouterBateau->bindValue(':largeur', $bateau->getLargeur());
        $requeteAjouterBateau->bindValue(':id_client', $bateau->getIdClient());

        $requeteAjouterBateau->execute();
    }

    public function modifierBateau(Bateau $bateau, $id)
    {
        $MODIFIER_BATEAU = "UPDATE bateau SET nom = :nom, type_bateau = :type_bateau, longueur = :longueur, largeur = :largeur WHERE id = :id";

        global $basededonnees;

        $requeteModifierBateau = $basededonnees->prepare($MODIFIER_BATEAU);

        $requeteModifierBateau->bindValue(':nom', $bateau->getNom());
        $requeteModifierBateau->bindValue(':type_bateau', $bateau->getTypeBateau());
        $requeteModifierBateau->bindValue(':longueur', $bateau->getLongueur());
        $requeteModifierBateau->bindValue(':largeur', $bateau->getLargeur());
        $requeteModifierBateau->bindValue(':id', $id);

        echo $requeteModifierBateau->queryString();
        echo '<br>'.$bateau->getNom();
        echo '<br>'.$bateau->getTypeBateau();
        echo '<br>'.$bateau->getLargeur();
        echo '<br>'.$bateau->getLongueur();
        echo '<br>'.$bateau->getIdbateau();

        $requeteModifierBateau->execute();
    }

    public function trouverBateau($id)
    {
        global $basededonnees;
        $TROUVER_BATEAU = 'SELECT * FROM bateau WHERE id = :id';
        $requeteTrouverBateau = $basededonnees->prepare($TROUVER_BATEAU);
        $requeteTrouverBateau->bindValue(':id', $id);
        $requeteTrouverBateau->execute();

        return $requeteTrouverBateau->fetch(PDO::FETCH_OBJ);
    }

    public function supprimerBateau($id)
    {
        global $basededonnees;
        $SUPPRIMER_BATEAU = 'DELETE FROM bateau WHERE id = :id';
        $requeteSupprimerBateau = $basededonnees->prepare($SUPPRIMER_BATEAU);
        $requeteSupprimerBateau->bindValue(':id', $id);
        $requeteSupprimerBateau->execute();
    }
}
/*
$bateau = new BateauDAO();

foreach($bateau->listerBateau() as $row ) {
    echo $row->nom;
    echo '<br>';
}*/
