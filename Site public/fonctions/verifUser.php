<?php

/*$clientDAO = new ClientDAO();
$client = $clientDAO->trouverClientMail($_SESSION['pseudo']);;

if (!$client->bool_gerant) {
    header('Location: partieClient.php');
    exit();
}*/

if (empty($_SESSION['pseudo'])){
    header('Location: connexion.php');
    exit();
}

?>