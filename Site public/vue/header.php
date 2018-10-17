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
<html lang="en" class="h-100" style="font-family: 'Roboto', sans-serif;">
<head>
    <meta charset="UTF-8">
    <title>MarinaConnect</title>

    <link rel="icon" href="../img/marina.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body class="h-100" style="background-color: #E1F5FE;font-family: 'Roboto', sans-serif;">
<div class="w3-top">
    <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
        <a href="index.php" class="w3-bar-item w3-button w3-theme-l1">Marina Connect&trade;</a>
        <a href="deconnexion.php" class="w3-bar-item w3-button w3-theme-l1 w3-right">Se déconnecter
            <a href="partieClient.php" class="w3-bar-item w3-button w3-theme-l1 w3-right">Mon compte</a>

    </div>
</div>
<div class="w3-content w3-padding-64 shadow w3-mobile" style="min-height: 95.2%; background-color: white;">

