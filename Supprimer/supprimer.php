<?php
session_start();
require_once('../Classes/bdd.class.php');
require_once('../Classes/supprimer.class.php');
echo'<main>';
$pageSuppr = new Delete;
$pageSuppr->DeleteArticle();
echo'</main>';
require_once('../html_partials/footer.php');
?>