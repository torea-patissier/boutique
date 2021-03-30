<?php 
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageCPromo = new codes_promo;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codes Promo</title>
</head>
<main>

    <p>Ajouter noveau code promo</p>
    <form action="codes_promo.php" method="POST">
        <input type="text" name="code" placeholder="Nom du nouveau code">
        <input type="text" name="valeur" placeholder="Valeur du nouveau code">
        <input type="submit" name="ajouter" value="Créer">
    </form>
    <p>Testez votre code promo</p>
    <form action="codes_promo.php" method="POST">
        <input type="text" name="prix" placeholder="Prix Test">
        <input type="text" name="code_test" placeholder="Code à tester">
        <input type="submit" name="reduire" value="Tester">
    </form>
    <p>Supprimer un code promo</p>
    <form action="codes_promo.php" method="POST">
        <input type="text" name="code_supp" placeholder="Nom du code à supprimer">
        <input type="submit" name="supprimer" value="Supprimer">
    </form>


    <?php

    $pageCPromo->showCodePromo();

        if (isset($_POST["ajouter"])){
            $pageCPromo -> ajouterCodePromo();
        }

        if (isset($_POST["reduire"])){
            $pageCPromo->testCode();
        }

        if (isset($_POST["supprimer"])){
            $pageCPromo->supprimerCodePromo();
        }
        require_once('../html_partials/footer.php');

    ?>