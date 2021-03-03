<?php
require_once('../Classes/bdd.class.php');

class GestionProduit extends bdd{

    public function AfficherCategoriesBdd()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM categories");
        $req->execute();
        $result = $req->fetchAll();

        echo "<h2> Catégories : </h2>";
        foreach ($result as $resultat){
            echo $resultat["nom"] . "<br />";
        }
    }

    public function AfficherSCategoriesBdd()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM sous_categories");
        $req->execute();
        $result = $req->fetchAll();

        echo "<h3> Sous Catégories : </h3>";
        foreach ($result as $resultat){
            echo $resultat["nom"] . "<br />";
        }
    }



    public function AjouterCategorieBdd()
    {   
        $newCategorie = htmlspecialchars($_POST["newCategorie"]);
        $con = $this->connectDb();
        $req = $con->prepare("INSERT into categories (nom) values (:newCategorie)");
        $req->bindValue("newCategorie", $newCategorie, PDO::PARAM_STR);
        $req->execute();

    }

    public function AjouterSCategorieBdd()
    {    
            $con = $this->connectDb(); // Connexion Db 
            $stmt = $con->prepare("SELECT * FROM categories");// Requete
            $stmt->execute();//J'éxécute la requete
            $result = $stmt->fetchAll();//Result devient un tableau des valeurs obtenues
            $newSCategorie = htmlspecialchars($_POST["newSCategorie"]);//
            $selectedValue = htmlspecialchars($_POST["categorie"]);
            foreach($result as $resultat){
                if($selectedValue == $resultat['id']){
                    $idCategorie = $resultat['id'];
                    $categorie = $resultat['nom'];
                }
            }
                
                $stmt = $con->prepare("INSERT INTO sous_categories (nom, id_categories) values (:nom, :id_categorie)");
                $stmt->bindValue('nom', $newSCategorie, PDO::PARAM_STR);
                $stmt->bindValue('id_categorie', $idCategorie, PDO::PARAM_INT);
                $stmt->execute();
        
    }

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
}