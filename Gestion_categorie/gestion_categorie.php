<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';

if ($id_droits != 2) {
    header('location:http://localhost/boutique/Error/404.php');
    exit();
}
$pageGestionCategorie = new gestion_categorie;

if (isset($_POST["valider"])) {
    if (!empty($_POST["newCategorie"])) {
        $pageGestionCategorie->AjouterCategorieBdd();
        header('location:http://localhost/boutique/Gestion_categorie/gestion_categorie.php');

    }
    if (!empty($_POST["newSCategorie"])) {
        $pageGestionCategorie->AjouterSCategorieBdd();
        header('location:http://localhost/boutique/Gestion_categorie/gestion_categorie.php');

    }
}

?>
<main>
    <?php
    echo "<div class='container'>";
    echo "<div class='row'>";
    echo "<div class='input-field col s12 m6 l6'>";
    $pageGestionCategorie->AfficherCategoriesBdd();
    echo "</div><br/>";
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
            <input class="btn black" type="submit" name="valider" value="Ajouter">
        </div><br/>

    </form>
</main>
<?php require_once('../html_partials/footer.php'); ?>