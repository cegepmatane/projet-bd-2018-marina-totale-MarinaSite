<?php
if (!(isset($_SESSION['admin']))){
header('Location: partieClient.php');
exit();
}?>