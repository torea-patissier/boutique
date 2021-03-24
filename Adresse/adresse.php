<?php
session_start();
include '../autoloader.php';
require_once('../html_partials/header.php');
echo'<main>';
$pageAdresse = new adresses();
var_dump($_SESSION['user']['id']);
?>
<a href="http://localhost:8888/boutique/profil/profil.php">Retour au profil</a><br /><br />

<h4>Adresse principale actuelle :</h4>
<?= $pageAdresse->ShowAndDeleteAdress(); ?>
<?= $pageAdresse->ShowMainAdresse(); ?>

<h4>Adresse(s) secondaire :</h4>

<?= $pageAdresse->ShowAndDeleteAdress2();?>
<?= $pageAdresse->ShowSecondaryAdress();?>

<?php

if (isset($_POST['envoyer'])) {
    $pageAdresse->AddAdress();
}

if (isset($_POST['envoyer2'])) {
    $pageAdresse->AddAdress2();
}
echo'</main>';
require_once('../html_partials/footer.php');

?>