<?php

require_once("bdd.class.php");

class faq extends bdd
{
    function AskQuestion()
    {    
            $con = $this->connectDb(); // Connexion Db 
            $stmt = $con->prepare("SELECT * FROM faq");// Requete
            $stmt->execute();//J'éxécute la requete
            $result = $stmt->fetchAll();//Result devient un tableau des valeurs obtenues
            $article = htmlspecialchars($_POST["newarticle"]);//
            $date = date("Y-m-d H:i:s");//
            $iduser = $_SESSION["user"]["id"];//Je récupère l'user id dans ma variable session
            $id_sous_categorie = 0; //////////A CHANGER  UNE FOIS LE PUSH DE NUNO SUR CATEGORIE ET SOUS CATEGORIE
            //Je change la valeur de l'input catégories selon le choix afin de l'introduire en base de données
            
            if(isset($_POST["category"]) && !empty($_POST["questionAPoser"])){
                $selectedValue = $_POST["category"];
                foreach($result as $resultat){
                    if($selectedValue == $resultat['id']){
                        $categorie = $resultat['nom'];
                    }
                }
                
                $stmt = $con->prepare("INSERT INTO articles (`article`, `id_utilisateur`, `id_categorie`, `date`) values (:article, :idUser, :selectedValue, '$date')");
                $stmt->bindValue('article', $article, PDO::PARAM_STR);
                $stmt->bindValue('idUser', $iduser, PDO::PARAM_INT);
                $stmt->bindValue('selectedValue', $selectedValue, PDO::PARAM_INT);
                $stmt->execute();
                    
            }
        
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

?>