<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$produits = new produits;
?>
<main class="divProduits">
<?php
$produits->showArticles();
?>
</main>
<?php
require_once('../html_partials/footer.php');
?>