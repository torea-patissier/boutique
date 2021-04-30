<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="CSS/materialize.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Boutique en ligne</title>
</head>
<?php
if (!isset($_SESSION['user'])) {
    $id_droits = 0;
} else {
    $id_droits = $_SESSION['user']['id_droits'];
}

?>

<body>
    <!-- Navbar pour un utilisateur qui est connecté et est un ADMIN-->
    <?php
    if ($id_droits == 2 ) {
    ?>
        <header>
            <!-- Sidenav à mettre en navbar si écran mobile -->
            <ul id="slide-out" class="sidenav">
                <li><a class="waves-effect" href="index.php"><i class="material-icons">home</i>Accueil</a></li><br />
                <li><a class="waves-effect" href="Produits/produits.php"><i class="material-icons">star_outline</i>Produits</a></li><br />
                <li><a class="waves-effect" href="Contact/contact.php"><i class="material-icons">contact_page</i>Contact</a></li><br />
                <li><a class="waves-effect" href="FAQ/faq.php"><i class="material-icons">contact_support</i>FAQ</a></li><br />
                <li><a class="waves-effect" href="Profil/profil.php"><i class="material-icons">person</i>Profil</a></li><br />
                <li><a class="waves-effect" href="Admin/admin.php"><i class="material-icons">settings</i>Admin</a></li><br />
                <li><a class="waves-effect" href="Produits/panier.php"><i class="material-icons">shopping_cart</i>Panier</a></li><br />
            </ul>
            <a data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </header>
    <?php }
    ?>

    <!-- Navbar pour un utilisateur qui est connecté-->
    <?php
    if ($id_droits == 1) {
    ?>
        <header>
            <!-- Sidenav à mettre en navbar si écran mobile -->
            <ul id="slide-out" class="sidenav">
                <li><a class="waves-effect" href="index.php"><i class="material-icons">home</i>Accueil</a></li><br />
                <li><a class="waves-effect" href="Produits/produits.php"><i class="material-icons">star_outline</i>Produits</a></li><br />
                <li><a class="waves-effect" href="Contact/contact.php"><i class="material-icons">contact_page</i>Contact</a></li><br />
                <li><a class="waves-effect" href="FAQ/faq.php"><i class="material-icons">contact_support</i>FAQ</a></li><br />
                <li><a class="waves-effect" href="Profil/profil.php"><i class="material-icons">person</i>Profil</a></li><br />
                <li><a class="waves-effect" href="Produits/panier.php"><i class="material-icons">shopping_cart</i>Panier</a></li><br />
            </ul>
            <a data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </header>
    <?php }
    ?>



    <!-- Navbar pour un utilisateur qui n'est pas connecté-->
    <?php
    if ($id_droits == 0) {
    ?>
        <header>
            <!-- Sidenav à mettre en navbar si écran mobile -->
            <ul id="slide-out" class="sidenav">
                <li><a class="waves-effect" href="index.php"><i class="material-icons">home</i>Accueil</a></li><br />
                <li><a class="waves-effect" href="Produits/produits.php"><i class="material-icons">star_outline</i>Produits</a></li><br />
                <li><a class="waves-effect" href="Contact/contact.php"><i class="material-icons">contact_page</i>Contact</a></li><br />
                <li><a class="waves-effect" href="FAQ/faq.php"><i class="material-icons">contact_support</i>FAQ</a></li><br />
                <li><a class="waves-effect" href="Connexion/connexion.php"><i class="material-icons">person</i>Connexion</a></li><br />
                <li><a class="waves-effect" href="Produits/panier.php"><i class="material-icons">shopping_cart</i>Panier</a></li><br />
            </ul>
            <a data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </header>
    <?php }
    ?>