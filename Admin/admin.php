<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';

if ($id_droits != 2) {
    header('location:http://localhost:8888/boutique/Error/404.php');
    exit();
}

$pageAdmin = new admin;

?>


<main>
    <h1 class="center-align"> BACK OFFICE ADMIN </h1><br /><br />
    <div class="container">
        <form action="" method="POST">
            <div class="row">
                <div class="col s12 m6 l6">
                    <input class="btn black" type="submit" name="articles" value="Gérer les articles">
                    <br /><br />
                </div>
                <div class="col s12 m6 l6">
                    <input class="btn black" type="submit" name="categories" value="Gérer les catégories">
                    <br /><br />
                </div>
                <div class="col s12 m6 l6">
                    <input class="btn black" type="submit" name="utilisateurs" value="Gérer les utilisateurs">
                    <br /><br />
                </div>
                <div class="col s12 m6 l6">
                    <input class="btn black" type="submit" name="codes" value="Gérer les codes promos">
                    <br /><br />
                </div>
            </div>
        </form><br/>
    </div><br/>
    <?php

    if (isset($_POST["articles"])) {
        header('Location: http://localhost:8888/boutique/Gestion_article/gestion_article.php');
    }

    if (isset($_POST["categories"])) {
        header('Location: http://localhost:8888/boutique/Gestion_categorie/gestion_categorie.php');
    }

    if (isset($_POST["utilisateurs"])) {
        header('Location: http://localhost:8888/boutique/Gestion_utilisateur/gestion_utilisateur.php');
    }

    if (isset($_POST["codes"])) {
        header('Location: http://localhost:8888/boutique/Codes_promo/codes_promo.php');
    }

    ?>
</main>
<?php require_once('../html_partials/footer.php'); ?>