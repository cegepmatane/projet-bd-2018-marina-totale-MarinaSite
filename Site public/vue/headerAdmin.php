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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<div class="w3-top">
    <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
        <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
        <a href="index.php" class="w3-bar-item w3-button w3-theme-l1">Marina Connect&trade;</a>
        <a href="deconnexion.php" class="w3-bar-item w3-button w3-theme-l1 w3-right">Se déconnecter</a>

    </div>
</div>

<body class="h-100" style="background-color: #E1F5FE;font-family: 'Roboto', sans-serif;">
<div class="container w3-padding-64 shadow" style="min-height:95.2%;background-color: white;">

