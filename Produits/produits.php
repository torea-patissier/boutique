<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$produits = new produits;
?>
<main class="container">
    <?php $produits->showArticles(); ?>
</main>
<?php
echo'<hr>';
require_once('../html_partials/footer.php');
?>
