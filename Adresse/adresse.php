<?php
session_start();
include '../autoloader.php';
require_once('../html_partials/header.php');
echo'<main>';
$pageAdresse = new adresses();
?>
<a href="http://localhost:8888/boutique/profil/profil.php">Retour au profil</a><br /><br />

<h4>Adresse principale actuelle :</h4>
<?= $pageAdresse->ShowAndDeleteAdress(); ?>
<?= $pageAdresse->ShowMainAdresse(); ?>

<?php

if (isset($_POST['envoyer'])) {
    $pageAdresse->AddAdress();
}

echo'</main>';
require_once('../html_partials/footer.php');

?>