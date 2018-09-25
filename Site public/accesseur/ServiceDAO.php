<?php
include_once "baseDeDonnee.php";

Class ServiceDAO{

    public function listerService(){
        $LISTER_SERVICE = "SELECT * FROM service";
        global $basededonnees;
        $requeteListerService = $basededonnees->prepare($LISTER_SERVICE);
        $requeteListerService->execute();

        return $requeteListerService->fetchAll(PDO::FETCH_OBJ);
    }

}