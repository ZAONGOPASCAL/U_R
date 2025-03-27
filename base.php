<?php
try
{
// On se connecte à MySQL
$conn = new PDO('mysql:host=localhost;dbname=AUBEN', 'root', '');
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
       die('Erreur : '.$e->getMessage());
}
?>