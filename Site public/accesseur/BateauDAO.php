<?php
include_once "baseDeDonnee.php";

Class BateauDAO{
    public function listerBateau(){
        $LISTER_BATEAU = "SELECT * FROM bateau";
        global $basededonnees;
        $requeteListerBateau = $basededonnees->prepare($LISTER_BATEAU);
        $requeteListerBateau->execute();

        return $requeteListerBateau->fetchAll(PDO::FETCH_OBJ);
    }

    public function ajouterBateau(Bateau $bateau){
        $AJOUTER_BATEAU = "INSERT INTO bateau (nom,type_bateau, longueur, largeur) VALUES (:nom, :type_bateau, :longueur, :largeur)";

        global $basededonnees;

        $requeteAjouterBateau = $basededonnees->prepare($AJOUTER_BATEAU);

        $requeteAjouterBateau->bindValue(':nom',$bateau->getNom());
        $requeteAjouterBateau->bindValue(':type_bateau',$bateau->getTypeBateau());
        $requeteAjouterBateau->bindValue(':longueur',$bateau->getLongeur());
        $requeteAjouterBateau->bindValue(':largeur',$bateau->getLargeur());

        $requeteAjouterBateau->execute();
    }

    public function modifierBateau(Bateau $bateau){
        $MODIDIER_BATEAU = "UDPDATE bateau SET nom = :nom, type_bateau = :type_bateau, longueur = :longueur, largeur = :largeur";
        //$AJOUTER_BATEAU = "INSERT INTO bateau (nom,type_bateau, longeur, largeur) VALUES (".$bateau->getNom().",".$bateau->getTypeBateau().",".$bateau->getLongeur().",".$bateau->getLargeur().")";

        global $basededonnees;

        $requeteAjouterBateau = $basededonnees->prepare($MODIDIER_BATEAU);

        $requeteAjouterBateau->bindValue(':nom',$bateau->getNom());
        $requeteAjouterBateau->bindValue(':type_bateau',$bateau->getTypeBateau());
        $requeteAjouterBateau->bindValue(':longueur',$bateau->getLongeur());
        $requeteAjouterBateau->bindValue(':largeur',$bateau->getLargeur());

        $requeteAjouterBateau->execute();
    }

    public function trouverBateau($id){
        global $basededonnees;
        $TROUVER_BATEAU = 'SELECT * FROM bateau WHERE id = :id';
        $requeteTrouverBateau = $basededonnees->prepare($TROUVER_BATEAU);
        $requeteTrouverBateau->bindValue(':id', $id);
        $requeteTrouverBateau->execute();

        return $requeteTrouverBateau->fetch(PDO::FETCH_OBJ);
    }
}
/*
$bateau = new BateauDAO();

foreach($bateau->listerBateau() as $row ) {
    echo $row->nom;
    echo '<br>';
}*/
