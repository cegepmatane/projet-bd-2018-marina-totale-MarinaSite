<?php

/*$clientDAO = new ClientDAO();
$client = $clientDAO->trouverClientMail($_SESSION['pseudo']);;

if (!$client->bool_gerant) {
    header('Location: partieClient.php');
    exit();
}*/

if (empty($_SESSION['pseudo'])){
    if (isset($_SERVER['REQUEST_URI'])){
        $_SESSION['redirection'] = $_SERVER['REQUEST_URI'];
    }
    header('Location: connexion.php');
    exit();
}

?>