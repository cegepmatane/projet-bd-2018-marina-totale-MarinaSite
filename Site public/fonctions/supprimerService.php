<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];

    include '../accesseur/ServiceDAO.php';
    $serviceDAO = new ServiceDAO();
    $serviceDAO->supprimerService($id);

    header('Location: ../vue/partieGerant.php');
    exit();
}