<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageProfil = new profil();

if (!isset($_SESSION['user'])) {

    header('location:http://localhost:8888/boutique/index.php');
}

?>
<main class="container">
    <div class="center-align">
        <h2><?php echo 'Bonjour, ';
            $pageProfil->voirPrenom(); ?></h2>
        <p>Pour modifier vos informations, veuillez remplir les champs ci-dessous</p>
    </div>
    <form action="profil.php" method="POST">
        <div class="row">
            <div class="col m6">

                <label class="labelProfil">Nom :</label>
                <input class="zonetxt_profil" type="text" name="nom" placeholder=<?php $pageProfil->voirNom(); ?>><br /><br />

                <label class="labelProfil">Prénom :</label>
                <input class="zonetxt_profil" type="text" name="prenom" placeholder=<?php $pageProfil->voirPrenom(); ?>><br /><br />

                <label class="labelProfil">Date de naissance :</label><br />
                <input class="zonetxt_profil" type="text" name="date_naissance" placeholder=<?php $pageProfil->voirDate(); ?>><br /><br />
    
                <label class="labelProfil"><i class="material-icons">phone_enabled</i></label><br />
                <input class="zonetxt_profil" type="number" name="tel" placeholder=<?php $pageProfil->voirTel(); ?>><br /><br />

            </div>
            <div class="col m6">
                <label class="labelProfil">Identifiant :</label><br />
                <input class="zonetxt_profil" type="text" name="login" placeholder=<?php $pageProfil->voirLogin(); ?>><br /><br />

                <label class="labelProfil">Modifiez votre mot de passe :</label><br />
                <input class="zonetxt_profil" type="password" name="password" placeholder="Mot de passe"><br /><br />

                <label class="labelProfil">Confirmation de mot de passe :</label><br />
                <input class="zonetxt_profil" type="password" name="confpass" placeholder="Confirmez ici"><br /><br />

                <label class="labelProfil"><i class="material-icons">email</i></label><br />
                <input class="zonetxt_profil" type="email" name="email" placeholder=<?php $pageProfil->voirEmail(); ?>><br /><br />
            </div>
        </div>

        <div class="center-align" >
            <a> <input class="btn black" type="submit" value="Modifier" name="modifier"></a>
            <a> <input class="btn black" type="submit" value=" Déconnexion" name="deco"> </a>
        </div>

    </form>

    <div class="row">
    <h6 class="left-align"><a class="col m6 s6"  href="http://localhost:8888/boutique/Adresse/adresse.php"><i class="material-icons">local_shipping</i> <br /> Adresse de livraison </a></h6>
    <h6 class="right-align"><a class="col m6 s6" href="http://localhost:8888/boutique/Historique_commande/historique_commande.php"><i class="material-icons">art_track</i> <br /> Historique des commandes</a></h6>
    </div>
    <?php

    if (isset($_POST['deco'])) {

        $pageProfil->Deconnexion();
    }
    if (isset($_POST['modifier'])) {

        $pageProfil->modifierProfil();
    }
    ?>
</main>
<?php require_once('../html_partials/footer.php'); ?>