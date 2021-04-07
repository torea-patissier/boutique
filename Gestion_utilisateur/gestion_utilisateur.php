<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';

if ($id_droits != 2) {
    header('location:http://localhost:8888/boutique/index.php');
    exit();
}
echo'<main class="paginationArticles1">';
$pageModifUser = new gestion_utilisateur();
$pageModifUser->ShowIdDroits();
echo'</main>';
require_once('../html_partials/footer.php');
?>