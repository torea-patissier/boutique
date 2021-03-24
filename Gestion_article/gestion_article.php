<?php 
session_start();
require_once('../html_partials/header.php');
include "../Classes/gestion_article.class.php"; 
$pageGestion = new GestionProduit;
?>
    <main>
        <form name="addProduit" action="gestion_article.php" method="POST" enctype="multipart/form-data">
        <p>Nom du Produit :</p>
            <input type="text" name="nom_produit" placeholder="Nom du Produit"><br />
        <p>Prix de vente :</p>
            <input type="text" name="prix_produit" placeholder="Prix du Produit"><br />
        <p>Description du produit :</p>
            <input type="textarea" name="description_produit" placeholder="Décrivez le Produit"><br /><br />
            <!-- CREER LISTE DEROULANTE POUR CHOISIR LA CATEGORIE ET SOUS CATEGORIE DU PRODUIT -->
            <label>Catégorie du produit :</label><br /><br />
            <select name="Categorie">
            <?php $pageGestion->selectCategory(); ?>
            </select><br /><br />

            <label>Sous catégorie du produit :</label><br /><br />
            <select name="SCategorie">
            <?php $pageGestion->selectSCategory(); ?>
            </select><br /><br />
        <p>Qtt. Produits en Stock :</p>
            <input type="text" name="stock_produit" placeholder="En stock"><br /><br />
            <input type="file" name="img"><br /><br />
            <input type="submit" name="upload" value="Upload">
        </form>
    <!-- //Formulaire pour ajout d'image -->
    <?php if(isset($_POST["upload"])){
        $pageGestion->ajoutProduitBdd();
    }
    ?>
    </main>
<?php require_once('../html_partials/footer.php'); ?>