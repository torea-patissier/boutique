<?php 
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageGestionCategorie = new gestion_categorie;

if ($id_droits != 2) {
    header('location:http://localhost:8888/boutique/index.php');
    exit();
}

?>
    <main>
    <?php 
        $pageGestionCategorie->AfficherCategoriesBdd();
        $pageGestionCategorie->AfficherSCategoriesBdd();
    ?>
        <br /><br />
        <form name="Ajouter_Catégorie" action="gestion_categorie.php" method="POST">
            <input type="text" name="newCategorie" placeholder="Ajouter Categorie"><br /><br />
            <label>A quelle catégorie appartient la sous-catégorie ?</label><br />
            <select name="categorie">
            <?php $pageGestionCategorie->selectCategory(); ?>
            </select><br />
            <input type="text" name="newSCategorie" placeholder="Ajouter Sous Catégorie">
            <input type="submit" name="valider" value="Ajouter">
        </form>

    <?php if(isset($_POST["valider"])){
        if(!empty($_POST["newCategorie"])){
            $pageGestionCategorie->AjouterCategorieBdd();
            header("Refresh: 0;");

        }
        if(!empty($_POST["newSCategorie"])){
            $pageGestionCategorie->AjouterSCategorieBdd();
            header("Refresh: 0;");

        }
    }
    ?>
    </main>
<?php require_once('../html_partials/footer.php');?>