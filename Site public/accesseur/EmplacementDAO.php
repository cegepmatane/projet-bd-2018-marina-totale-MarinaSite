<?php
include_once "baseDeDonnee.php";

Class EmplacementDAO{

    public function listerEmplacement(){
        $LISTER_EMPLACEMENT = "SELECT * FROM emplacement";
        global $basededonnees;
        $requeteListerEmplacement = $basededonnees->prepare($LISTER_EMPLACEMENT);
        $requeteListerEmplacement->execute();

        return $requeteListerEmplacement->fetchAll(PDO::FETCH_OBJ);
    }

}