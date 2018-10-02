<?php
$port = "5432";
$host = "158.69.113.110";
$dbname = "MarinaBateauDB";
$utilisateur = 'webmestre';
$mdp = "bdd2018Marina";

$dsn = 'pgsql:host=localhost;port=5432;dbname=MarinaBateauDB';
$basededonnees = new PDO($dsn, $utilisateur, $mdp);
print_r($basededonnees);
?>