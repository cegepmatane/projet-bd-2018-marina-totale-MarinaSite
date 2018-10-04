<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];

    include '../accesseur/CientDAO.php';
    $clientDAO = new ClientDAO();
    $clientDAO->supprimerClient($id);

    header('Location: ../vue/connexion.php');
    exit();
}