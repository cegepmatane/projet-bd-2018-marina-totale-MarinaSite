<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];

    include '../accesseur/BateauDAO.php';
    $bateauDAO = new BateauDAO();
    $bateauDAO->supprimerBateau($id);

    header('Location: ../vue/partieClient.php');
    exit();
}