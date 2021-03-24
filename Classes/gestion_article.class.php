<?php
require_once('../Classes/bdd.class.php');

class GestionProduit extends bdd{

    function selectCategory()
    {
        $con = $this->connectDb(); // Connexion Db 
        $stmt = $con->prepare("SELECT * FROM categories");// Requete
        $stmt->execute();//J'éxécute la requete
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//Result devient un tableau des valeurs obtenues

        foreach($result as $resultat){
            $categorie = $resultat["nom"];
            $idCategorie = $resultat["id"];

            echo "<option value='$idCategorie'>$categorie</option>";
        
        }
    }

    function selectSCategory()
    {
        $con = $this->connectDb(); // Connexion Db 
        $stmt = $con->prepare("SELECT * FROM sous_categories");// Requete
        $stmt->execute();//J'éxécute la requete
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//Result devient un tableau des valeurs obtenues

        foreach($result as $resultat){
            $categorie = $resultat["nom"];
            $idCategorie = $resultat["id"];

            echo "<option value='$idCategorie'>$categorie</option>";
        
        }
    }

    public function ajoutProduitBdd()
    {
        $nomProduit = htmlspecialchars($_POST['nom_produit']);
        $prixProduit = htmlspecialchars($_POST['prix_produit']);
        $descriptionProduit = htmlspecialchars($_POST['description_produit']);
        $idCategorie = htmlspecialchars($_POST['Categorie']);
        $idSCategorie = htmlspecialchars($_POST['SCategorie']);
        $stockProduit = htmlspecialchars($_POST['stock_produit']);
        $fileName = $_FILES["img"]["name"];
        $fileSize = $_FILES["img"]["size"];
        $fileType = $_FILES["img"]["type"];
        $fileTmpName = file_get_contents($_FILES["img"]["tmp_name"]);
        $con = $this->connectDb();
        $req = $con->prepare("INSERT INTO produits(nom, prix, description, id_categorie, id_sous_categorie, stock, nom_image_produit, taille_image_produit, type_image_produit, bin_image_produit) values (:nom, :prix, :description, :id_categorie, :id_sous_categorie, :stock, :fileName, :fileSize, :fileType, :fileTmpName)");
        $req->bindValue("nom", $nomProduit, PDO::PARAM_STR);
        $req->bindValue("prix", $prixProduit, PDO::PARAM_STR);
        $req->bindValue("description", $descriptionProduit, PDO::PARAM_STR);
        $req->bindValue("id_categorie", $idCategorie, PDO::PARAM_INT);
        $req->bindValue("id_sous_categorie", $idSCategorie, PDO::PARAM_INT);
        $req->bindValue("stock", $stockProduit, PDO::PARAM_INT);
        $req->bindValue("fileName", $fileName, PDO::PARAM_STR);
        $req->bindValue("fileSize", $fileSize, PDO::PARAM_INT);
        $req->bindValue("fileType", $fileType, PDO::PARAM_STR);
        $req->bindValue("fileTmpName", $fileTmpName, PDO::PARAM_LOB);

        $req->execute();

    }

}