<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';

if ($id_droits != 2) {
    header('location:http://localhost:8888/boutique/index.php');
    exit();
}

$pageAdmin = new admin;
?>
    <main>
        <h1> BACK OFFICE ADMIN </h1>
        <form action="" method="POST">    
            <input type="submit" name="articles" value="Gèrer Articles">
            <input type="submit" name="categories" value="Gèrer Categories">
            <input type="submit" name="utilisateurs" value="Gèrer Users">
            <input type="submit" name="codes" value="Gèrer CodesP">
        </form>
    </main>
<?php 

    if(isset($_POST["articles"])){
        header('Location: http://localhost:8888/boutique/Gestion_article/gestion_article.php');
    }

    if(isset($_POST["categories"])){
        header('Location: http://localhost:8888/boutique/Gestion_categorie/gestion_categorie.php');
    }

    if(isset($_POST["utilisateurs"])){
        header('Location: http://localhost:8888/boutique/Gestion_utilisateur/gestion_utilisateur.php');
    }

    if(isset($_POST["codes"])){
        header('Location: http://localhost:8888/boutique/Codes_promo/codes_promo.php');
    }

require_once('../html_partials/footer.php');
?>