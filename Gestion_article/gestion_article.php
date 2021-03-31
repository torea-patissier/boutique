<?php 
session_start();
include "../Classes/gestion_article.class.php"; 
$pageGestion = new GestionProduit;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css"/>
    <title>Gestion Articles</title>
</head>
<body>
    <main>
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
            <?php $pageGestion->selectCategory(); ?>
            </select><br /><br />

            <label>Sous catégorie du produit :</label><br /><br />
            <select name="SCategorie">
            <?php $pageGestion->selectSCategory(); ?>
            </select><br /><br />
        <p>Qtt. Produits en Stock :</p>
            <input type="text" name="stock_produit" placeholder="En stock"><br /><br />
        <p>Chemin vers image du produit :</p>
            <input type="file" name="Img"><br /><br />
            <input type="submit" name="upload" value="Upload">
        </form>

    <?php 
        $pageGestion-> viewAllProduits();


    if(isset($_POST["upload"])){
        $pageGestion->ajoutProduitBdd();
    }
    ?>

    </main>
</body>
</html>