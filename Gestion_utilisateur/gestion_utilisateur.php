
<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';

if ($id_droits != 2) {
    header('location:http://localhost/boutique/Error/404.php');
    exit();
}

echo'<main class="paginationArticles1">';
?>
<h1 class="container">Gestion des utilisateurs : </h1><br/><br/>
<?php
$pageModifUser = new gestion_utilisateur();
$pageModifUser->ShowIdDroits();
echo'</main>';
require_once('../html_partials/footer.php');
?>