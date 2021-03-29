<?php
session_start();
require_once('../html_partials/header.php');
require_once('../Classes/modifier_utilisateur.class.php');
echo'<main class="paginationArticles1">';
$pageModifUser = new ModifUser();
$pageModifUser->ShowUtilisateur();
echo'</main>';
require_once('../html_partials/footer.php');
?>