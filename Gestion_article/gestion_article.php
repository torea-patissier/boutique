<?php 
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$gestion_article = new gestion_article;

if ($id_droits != 2) {
    header('location:http://localhost:8888/boutique/index.php');
    exit();
}

?>
    <main>
        <!-- Enctype pour pouvoir insérer une image à la Bdd -->
        <form name="addProduit" action="gestion_article.php" method="POST" enctype="multipart/form-data">
        <p>Nom du Produit :</p>
            <input type="text" name="nom_produit" placeholder="Nom du Produit"><br />
        <p>Prix de vente :</p>
            <input type="text" name="prix_produit" placeholder="Prix du Produit"><br />
        <p>Description du produit :</p>
            <textarea name="description_produit" placeholder="Décrivez le Produit" rows="4" cols="50"></textarea><br /><br />
            <!-- CREER LISTE DEROULANTE POUR CHOISIR LA CATEGORIE ET SOUS CATEGORIE DU PRODUIT -->
            <label>Catégorie du produit :</label><br /><br />
            <select name="Categorie">
            <?php $gestion_article->selectCategory(); ?>
            </select><br /><br />

            <label>Sous catégorie du produit :</label><br /><br />
            <select name="SCategorie">
            <?php $gestion_article->selectSCategory(); ?>
            </select><br /><br />
        <p>Qtt. Produits en Stock :</p>
            <input type="text" name="stock_produit" placeholder="En stock"><br /><br />
            <input type="file" name="img"><br /><br />
            <input type="submit" name="upload" value="Envoyer">
        </form><br />
    <!-- //Formulaire pour ajout d'image -->
    <?php 
    
    if(isset($_POST["upload"])){
        $gestion_article->ajoutProduitBdd();
    }
    
    $gestion_article->viewModifyDeleteArticle();
    ?>

    </main>
    <?php require_once('../html_partials/footer.php'); ?>
