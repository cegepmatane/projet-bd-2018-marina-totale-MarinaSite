<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Florent
 * Date: 07/09/2018
 * Time: 14:33
 */
if (!(isset($_SESSION['pseudo']))){
    header('Location: connexion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MarinaConnect</title>
    <link rel="stylesheet" href="cssMarinaConnect.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<header>
    <a href="partieClient.php">ACCEUIL CLIENT</a><br>
    <a href="deconnexion.php">Se deconnecter..</a>
</header>

<body>
    <div class="container">

