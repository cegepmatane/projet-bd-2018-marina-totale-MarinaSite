<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];

    include '../accesseur/EmplacementDAO.php';
    $emplacementDAO = new EmplacementDAO();
    $emplacementDAO->supprimerEmplacement($id);

    header('Location: ../vue/vueEmplacement.php');
    exit();
}