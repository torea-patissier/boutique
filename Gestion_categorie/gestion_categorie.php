<?php 
session_start();
include "../Classes/gestion_categorie.class.php"; 
$pageGestionCategorie = new GestionProduit;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Categories</title>
</head>
<body>
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
        }
        if(!empty($_POST["newSCategorie"])){
            $pageGestionCategorie->AjouterSCategorieBdd();
        }
    }
    ?>
    </main>
</body>
</html>