<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique en ligne</title>
</head>
<?php

    if(!isset($_SESSION['user'])){
        $id_droits = 0;
    }else{
        $id_droits = $_SESSION['user']['id_droits'];
    }

?>
<body>

     <!-- Navbar pour un utilisateur qui est connecté et est un ADMIN-->
    <?php
    if($id_droits == 2){
    ?>
    <header>
        <nav class="navbar">
            <a class="navlink" href="index.php">Accueil</a>
            <a class="navlink" href="Produit/produit.php">Produit</a>
            <a class="navlink" href="Produits/produits.php">Produits</a>
            <a class="navlink" href="Contact/contact.php">Contact</a>
            <a class="navlink" href="Qui_sommes_nous/infos.php">Qui sommes nous</a>
            <a class="navlink" href="FAQ/faq.php">FAQ</a>
            <a class="navlink" href="Profil/profil.php">Profil</a>
            <a class="navlink" href="Admin/admin.php">Admin</a>

        </nav>
    </header>
    <?php }?>

    <!-- Navbar pour un utilisateur qui est connecté-->
    <?php
    if($id_droits == 1){
    ?>
    <header>
        <nav class="navbar">
            <a class="navlink" href="index.php">Accueil</a>
            <a class="navlink" href="Produit/produit.php">Produit</a>
            <a class="navlink" href="Produits/produits.php">Produits</a>
            <a class="navlink" href="Contact/contact.php">Contact</a>
            <a class="navlink" href="Qui_sommes_nous/infos.php">Qui sommes nous</a>
            <a class="navlink" href="FAQ/faq.php">FAQ</a>
            <a class="navlink" href="Profil/profil.php">Profil</a>
        </nav>
    </header>
    <?php }?>


    
    <!-- Navbar pour un utilisateur qui n'est pas connecté-->
    <?php
    if($id_droits == 0){
    ?>
    <header>
        <nav class="navbar">
            <a class="navlink" href="index.php">Accueil</a>
            <a class="navlink" href="Produit/produit.php">Produit</a>
            <a class="navlink" href="Produits/produits.php">Produits</a>
            <a class="navlink" href="Contact/contact.php">Contact</a>
            <a class="navlink" href="Qui_sommes_nous/infos.php">Qui sommes nous</a>
            <a class="navlink" href="FAQ/faq.php">FAQ</a>
            <a class="navlink" href="Connexion/connexion.php">Connexion</a>
        </nav>
    </header>
    <?php }?>






    