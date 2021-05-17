<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
echo'<main>';
$commande = new produits;

if (!$_SESSION['user']) {
    header('location:http://localhost:8888/boutique/index.php');
    exit();
}

?>
<h1 class="center-align">Historique des commandes passés : </h1>
<?php
$commande->afficherCommande();
echo'</main>';
require_once('../html_partials/footer.php');
?>