<?php session_start(); 

require_once('../html_partials/header.php');
include "../Classes/admin.class.php"; 

$pageAdmin = new gestion;

?>


    <main>
        <h1> BACK OFFICE ADMIN </h1>
        <div class="container">
        <form action="" method="POST">
        <div class="row">
        <div class="col s12 m6 l6"> 
            <input class="btn black" type="submit" name="articles" value="Gèrer Articles">
            <br /><br />
        </div>
        <div class="col s12 m6 l6"> 
            <input class="btn black" type="submit" name="categories" value="Gèrer Categories">
            <br /><br />
        </div>
        <div class="col s12 m6 l6"> 
            <input class="btn black" type="submit" name="utilisateurs" value="Gèrer Users">
            <br /><br />
        </div>
        <div class="col s12 m6 l6"> 
            <input class="btn black" type="submit" name="codes" value="Gèrer CodesP">
            <br /><br />
        </div>
        </div>
   
        </form>
        </div>
<?php 

    if(isset($_POST["articles"])){
        header('Location: http://localhost/boutique/Gestion_article/gestion_article.php');
    }

    if(isset($_POST["categories"])){
        header('Location: http://localhost/boutique/Gestion_categorie/gestion_categorie.php');
    }

    if(isset($_POST["utilisateurs"])){
        header('Location: http://localhost/boutique/Gestion_utilisateur/gestion_utilisateur.php');
    }

    if(isset($_POST["codes"])){
        header('Location: http://localhost/boutique/Codes_promo/codes_promo.php');
    }

?>
    </main>
<?php require_once('../html_partials/footer.php'); ?>