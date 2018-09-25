<?php
include_once "baseDeDonnee.php";

Class ClientDAO{

    public function listerClient(){
        $LISTER_CLIENT = "SELECT * FROM client";
        global $basededonnees;
        $requeteListerClient = $basededonnees->prepare($LISTER_CLIENT);
        $requeteListerClient->execute();

        return $requeteListerClient->fetchAll(PDO::FETCH_OBJ);
    }

}