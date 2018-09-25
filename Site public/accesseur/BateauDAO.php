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
        $AJOUTER_BATEAU = "INSERT INTO bateau (nom, longeur, largeur) VALUES (:name, :longueur, :largeur)";
        global $basededonnees;

        $requeteAjouterBateau = $basededonnees->prepare($AJOUTER_BATEAU);

        $requeteAjouterBateau->bindParam(':nom',$bateau->getNom());
        $requeteAjouterBateau->bindParam(':longeur',$bateau->getLongeur());
        $requeteAjouterBateau->bindParam(':largeur',$bateau->getLargeur());

        $requeteAjouterBateau->execute();
    }
}
/*
$bateau = new BateauDAO();

foreach($bateau->listerBateau() as $row ) {
    echo $row->nom;
    echo '<br>';
}*/
