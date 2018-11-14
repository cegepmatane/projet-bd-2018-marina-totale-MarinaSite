<?php
/**
 * Created by PhpStorm.
 * User: zatur
 * Date: 13/11/2018
 * Time: 20:56
 */
session_start();
if ($_SESSION["lang"]==='fr'){
    $_SESSION['lang'] = "en";
}else{
    $_SESSION['lang'] = "fr";
}
header('Location: connexion.php');