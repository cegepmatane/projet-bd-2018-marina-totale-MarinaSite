<?php
session_start();
$_SESSION['pseudo'] = null;
$_SESSION['admin'] = null;
$_SESSION['id'] = null;
header('Location: connexion.php');
exit();
?>