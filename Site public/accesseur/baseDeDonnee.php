<?php
$host = "host = 158.69.113.110";
$port = "port = 5432";
$dbname = "dbname = MarinaBateauDB";
$credentials = "user=webMestre password=bdd2018Marina";

$db = pg_connect("$host $port $dbname $credentials");
?>