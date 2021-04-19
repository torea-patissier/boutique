<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
echo'<main>';
$profil = new profil;
$adresse = new adresses;
$commande = new produits;
$profil->voirInfosProfil();
$adresse->voirAdressePrincipal();
?>
<h1>Historique des commandes passés : </h1>
<?php
$commande->afficherCommande();
echo'</main>';
require_once('../html_partials/footer.php');
?>