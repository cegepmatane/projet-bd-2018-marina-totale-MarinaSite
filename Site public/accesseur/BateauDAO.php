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
}
/*
$bateau = new BateauDAO();

foreach($bateau->listerBateau() as $row ) {
    echo $row->nom;
    echo '<br>';
}*/
