<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../style.css"/>

    <title>Document</title>
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
        <div class="btn-navigation">
            <div class="barre"></div>
            <div class="barre"></div>
            <div class="barre"></div>
        </div>
        <div class="navigation">
            <ul>
                <li><a class="navlink" href="../index.php">Accueil</a></li>
                <li><a class="navlink" href="../Produit/produit.php">Produit</a></li>
                <li><a class="navlink" href="../Produits/produits.php">Produits</a></li>
                <li><a class="navlink" href="../Contact/contact.php">Contact</a></li>
                <li><a class="navlink" href="../Qui_sommes_nous/infos.php">Qui sommes nous</a></li>
                <li><a class="navlink" href="../FAQ/faq.php">FAQ</a></li>
                <li><a class="navlink" href="../Profil/profil.php">Profil</a></li>
                <li><a class="navlink" href="../Admin/admin.php">Admin</a></li>
                <li><a class="navlink" href="../Produits/panier.php">Panier</a></li>
            </ul>
        </div>
    </header>
    <?php }?> 

<!-- Navbar pour un utilisateur qui est connecté-->
<?php
if($id_droits == 1){
?>
<header>
        <div class="btn-navigation">
            <div class="barre"></div>
            <div class="barre"></div>
            <div class="barre"></div>
        </div>
        <div class="navigation">
            <ul>
                <li><a class="navlink" href="../index.php">Accueil</a></li>
                <li><a class="navlink" href="../Produit/produit.php">Produit</a></li>
                <li><a class="navlink" href="../Produits/produits.php">Produits</a></li>
                <li><a class="navlink" href="../Contact/contact.php">Contact</a></li>
                <li><a class="navlink" href="../Qui_sommes_nous/infos.php">Qui sommes nous</a></li>
                <li><a class="navlink" href="../FAQ/faq.php">FAQ</a></li>
                <li><a class="navlink" href="../Profil/profil.php">Profil</a></li>
                <li><a class="navlink" href="../Produits/panier.php">Panier</a></li>
            </ul>
        </div>
    </header>
<?php }?>



<!-- Navbar pour un utilisateur qui n'est pas connecté-->
<?php
if($id_droits == 0){
?>
<header>
        <div class="btn-navigation">
            <div class="barre"></div>
            <div class="barre"></div>
            <div class="barre"></div>
        </div>
        <div class="navigation">
            <ul>
                <li><a class="navlink" href="../index.php">Accueil</a></li>
                <li><a class="navlink" href="../Produit/produit.php">Produit</a></li>
                <li><a class="navlink" href="../Produits/produits.php">Produits</a></li>
                <li><a class="navlink" href="../Contact/contact.php">Contact</a></li>
                <li><a class="navlink" href="../Qui_sommes_nous/infos.php">Qui sommes nous</a></li>
                <li><a class="navlink" href="../FAQ/faq.php">FAQ</a></li>
                <li><a class="navlink" href="../Connexion/connexion.php">Connexion</a></li>
            </ul>
        </div>
    </header>
<?php }?>
