<?php 
session_start();
include "../Classes/gestion_categorie.class.php"; 
require_once('../html_partials/header.php');
$pageGestionCategorie = new GestionProduit;
?>

    <main>
    <?php 
    echo "<div class='container'>";
    echo "<div class='row'>";
    echo "<div class='input-field col s12 m6 l6'>";
        $pageGestionCategorie->AfficherCategoriesBdd();
        echo "</div>";
    echo "<div class='input-field col s12 m6 l6'>";
        $pageGestionCategorie->AfficherSCategoriesBdd();
        echo "</div>";
    echo "</div>";
    echo "</div>";
    ?>
        <br /><br />
        <form name="Ajouter_Catégorie" action="gestion_categorie.php" method="POST">
        <div class="container">
        <div class="row">
        <div class="input-field col s12 m6 l6">
            <label>Nom de la nouvelle Catégorie :</label><br />
            <input type="text" name="newCategorie" placeholder="Ajouter Categorie"><br /><br />
        </div>

        <div class="input-field col s12 m6 l6">
            <label>A quelle catégorie appartient la sous-catégorie ?</label><br />
            <select name="categorie">
                <?php $pageGestionCategorie->selectCategory(); ?>
            </select><br />
            <input type="text" name="newSCategorie" placeholder="Nom de la Sous-Catégorie">
        </div>
        </div>
        </div>
            <input class="btn black"type="submit" name="valider" value="Ajouter">

        </form>

    <?php if(isset($_POST["valider"])){
        if(!empty($_POST["newCategorie"])){
            $pageGestionCategorie->AjouterCategorieBdd();
        }
        if(!empty($_POST["newSCategorie"])){
            $pageGestionCategorie->AjouterSCategorieBdd();
        }
    }
    ?>
    </main>
    <?php require_once('../html_partials/footer.php'); ?>