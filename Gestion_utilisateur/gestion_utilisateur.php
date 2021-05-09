<?php
session_start();
require_once('../html_partials/header.php');
require_once('../Classes/gestion_utilisateur.class.php');
echo'<main class="paginationArticles1">';
$pageModifUser = new ModifUser();
$pageModifUser->ShowIdDroits();
echo'</main>';
require_once('../html_partials/footer.php');
?>

