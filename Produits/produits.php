<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$produits = new produits;
$produits->showArticles();
echo'<hr>';
require_once('../html_partials/footer.php');
?>
