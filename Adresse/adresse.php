<?php
session_start();
include '../autoloader.php';
require_once('../html_partials/header.php');
echo '<main class="container">';
$pageAdresse = new adresses();

if (!$_SESSION['user']) {
    header('location:http://localhost/boutique/index.php');
    exit();
}

?>
<br />
    <a class="btn black" href="http://localhost/boutique/profil/profil.php">Retour au profil</a><br /><br />
    <h1>Adresse actuelle :</h1>
    <i class="material-icons">home</i> <br />
    <?= $pageAdresse->ShowAndDeleteAdress(); ?>
    <?= $pageAdresse->ShowMainAdresse(); ?><br /><br />


<h2>Délais de livraison :</h2>
</p>France Métropolitaine : 1 à 2 jours, pour une commande passée et validée avant 12H00 (+1 jour pour les commandes validées après 12H00)<br />
Corse et iles métropolitaines : + 2 jours<br />
DOM : entre 5 et 10 jours<br />
TOM : entre 10 et ...... jours (selon le transport choisi) <br />
Belgique, Pays-bas : 2-3 jours, pour une commande passée et validée avant 12H00 <br />
Luxembourg : 2 à 3 jours, pour une commande passée et validée avant 12H00<br />
Allemagne : 2 à 3 jours, pour une commande passée et validée avant 12H00 <br />
Grande-bretagne & Irlande: 2 à 4 jours, pour une commande passée et validée avant 12H00 <br />
Italie : 4 à 5 jours, pour une commande passée et validée avant 12H00<br />
Espagne : 3 à 4 jours, pour une commande passée et validée avant 12H00 <br />
Portugal : 3 à 4 jours, pour une commande passée et validée avant 12H00 <br />
Scandinavie : 3 à 5 jours,, pour une commande passée et validée avant 12H00<br />
Pologne : 4 à 5 jours, pour une commande passée et validée avant 12H00<br />
Suisse : 5 à 7 jours, pour une commande passée et validée avant 12H00. Des taxes locales s'appliquent.<br />
Autriche : 3 à 4 jours, pour une commande passée et validée avant 12H00.<br /></p>
<?php

if (isset($_POST['envoyer'])) {
    $pageAdresse->AddAdress();
}

echo '</main>' . '<br />';
require_once('../html_partials/footer.php');
?>