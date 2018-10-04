<?php
session_start();
$_SESSION['pseudo'] = null;
$_SESSION['admin'] = null;
header('Location: connexion.php');
exit();
?>