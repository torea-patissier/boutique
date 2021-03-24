<?php
session_start();
include '../autoloader.php';
echo'<main>';
$pageSuppr = new supprimer;
$pageSuppr->DeleteAdress();
$pageSuppr->DeleteSecondaryAdress();
echo'</main>';
?>
