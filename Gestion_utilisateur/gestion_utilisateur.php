<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
echo'<main class="paginationArticles1">';
$pageModifUser = new gestion_utilisateur();
$pageModifUser->ShowIdDroits();
echo'</main>';
require_once('../html_partials/footer.php');
?>