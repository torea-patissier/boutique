<?php
session_start();
include '../autoloader.php';

echo'<main>';
$pageSuppr = new supprimer;
$pageSuppr->DeleteAdress();
echo'</main>';
var_dump($_SESSION['user']['id']);
var_dump($_GET['id']);

?>
