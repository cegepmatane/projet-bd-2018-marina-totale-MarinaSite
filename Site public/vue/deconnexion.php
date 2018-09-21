<?php
session_start();
$_SESSION['pseudo'] = null;
$_SESSION['admin'] = null;
header('Location: index.php');
exit();
?>