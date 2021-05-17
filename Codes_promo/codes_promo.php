<?php 
session_start();
include '../autoloader.php';
require_once('../html_partials/header.php');
$pageCPromo = new codes_promo;

if ($id_droits != 2) {
    header('location:http://localhost:8888/boutique/Error/404.php');
    exit();
}

?>


<main>
    <div class='container'>
    <?php $pageCPromo->showCodePromo(); ?>

    <br /><br /><br />
    <p>Ajouter nouveau code promo</p>
    <form action="codes_promo.php" method="POST">
    <div class="input-field col s4 m4 l4">
        <input type="text" name="code" placeholder="Nom du nouveau code">
    </div>
    <div class="input-field col s4 m4 l4">
        <input type="text" name="valeur" placeholder="Valeur du nouveau code">
    </div>
        <input class="btn black" type="submit" name="ajouter" value="Créer">
    </form>
    <br /><br /><br />
    <p>Testez votre code promo</p>
    <form action="codes_promo.php" method="POST">
    <div class="input-field col s4 m4 l4">
        <input type="text" name="prix" placeholder="Prix Test">
    </div>
    <div class="input-field col s4 m4 l4">
        <input type="text" name="code_test" placeholder="Code à tester">
    </div>
        <input class="btn black" type="submit" name="reduire" value="Tester">
    </form>
    <br /><br /><br />
    <p>Supprimer un code promo</p>
    <form action="codes_promo.php" method="POST">
    <div class="input-field col s4 m4 l4">
        <input type="text" name="code_supp" placeholder="Nom du code à supprimer">
    </div>  
        <input class="btn black" type="submit" name="supprimer" value="Supprimer">
    </form>
    </div>


    <?php



        if (isset($_POST["ajouter"])){
            $pageCPromo -> ajouterCodePromo();
        }

        if (isset($_POST["reduire"])){
            $pageCPromo->testCode();
        }

        if (isset($_POST["supprimer"])){
            $pageCPromo->supprimerCodePromo();
        }
    ?>


</main>
<?php require_once('../html_partials/footer.php'); ?>