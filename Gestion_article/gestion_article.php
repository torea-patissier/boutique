<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';

if ($id_droits != 2) {
    header('location:http://localhost:8888/boutique/Error/404.php');
    exit();
}
$pageGestion = new gestion_article;
$pageGestion->DeleteProduit();

?>
<main>
    <div class="container">
        <h1 class="center-align">Gestion Produits</h1><br />
        <br />
        <form action="" method="POST">
            <div class="row">
                <div class="col s12">
                    <input class="btn black" type="submit" name="AjouterProduit" value="Ajouter Produit">
                </div><br />
                <br /><br /><br />

                <div class="col s12">
                    <input class="btn black" type="submit" name="tousProduits" value="Consulter Produits">
                </div>
            </div>
        </form>
    </div><br/><br/>
    <?php

if (isset($_GET['show'])) {

    $pageGestion->ModifierProduit();
}

if (isset($_POST["tousProduits"])) {
    $pageGestion->viewAllProduits();
}

if (isset($_POST["upload"])) {
    $pageGestion->ajoutProduitBdd();
}


    if (isset($_POST["AjouterProduit"])) {

    ?>
        <br /><br /><br /><br />
        <form name="addProduit" action="gestion_article.php" method="POST" enctype="multipart/form-data">

            <div class="container">
                <div class="row">

                    <div class="input-field col s12 m4">
                        <p>Nom du Produit :</p>
                        <input type="text" name="nom_produit" placeholder="Nom du Produit"><br />
                    </div>

                    <div class="input-field col s12 m4">
                        <p>Prix de vente :</p>
                        <input type="text" name="prix_produit" placeholder="Prix du Produit"><br />
                    </div>

                    <div class="input-field col s12 m4">
                        <p>Description du produit :</p>
                        <textarea name="description_produit" placeholder="Décrivez le Produit" rows="4" cols="50"></textarea><br /><br />
                        <!-- CREER LISTE DEROULANTE POUR CHOISIR LA CATEGORIE ET SOUS CATEGORIE DU PRODUIT -->
                    </div>

                    <div class="input-field col s12 m4">
                        <label>Catégorie du produit :</label><br /><br />
                        <select name="Categorie">
                            <?php $pageGestion->selectCategory(); ?>
                        </select><br /><br />
                    </div>

                    <div class="input-field col s12 m4">
                        <label>Sous catégorie du produit :</label><br /><br />
                        <select name="SCategorie">
                            <?php $pageGestion->selectSCategory(); ?>
                        </select><br /><br />
                    </div>

                    <div class="input-field col s12 m4">
                        <p>Quantité de produits en stock :</p>
                        <input type="text" name="stock_produit" placeholder="En stock"><br /><br />
                    </div><br />

                    <p class="left-align">Chemin vers image du produit :</p>
                    <input type="file" name="Img"><br /><br />
                    <input class="btn black" type="submit" name="upload" value="Valider">
                </div>
            </div>

        </form>

    <?php
    }
    ?>
</main>
<?php require_once('../html_partials/footer.php'); ?>