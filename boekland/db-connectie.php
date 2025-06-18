
<?php


$host = 'localhost';
$user = 'bit_academy';
$passw = 'bit_academy';
$dbnaam = 'backendwebshop';

$db = 'mysql:host=' . $host . ';dbname=' . $dbnaam;

$connectie = new pdo($db, $user, $passw) 
?>