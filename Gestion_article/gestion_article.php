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
    <title>Gestion Articles</title>
</head>
<body>
    <main>
        <form name="addProduit" action="gestion_article.php" method="POST">
            <input type="text" name="nom_produit" placeholder="Nom du Produit">
            <input type="text" name="prix_produit" placeholder="Prix du Produit">
            <input type="text" name="nom_produit" placeholder="Nom du Produit">
            <input type="textarea" name="description_produit" placeholder="Décrivez le Produit">
            <!-- CREER LISTE DEROULANTE POUR CHOISIR LA CATEGORIE ET SOUS CATEGORIE DU PRODUIT -->
            <input type="text" name="stock_produit" placeholder="En stock">
        </form>
    <!-- //Formulaire pour ajout d'image -->
        <form name="img_up" action="gestion_article.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="img"><br /><br />
            <input type="submit" name="upload" value="Upload">
        </form>
    <?php if(isset($_POST["upload"])){
        $pageGestion->ajoutImgArticle();
    }
    ?>
    </main>
</body>
</html>