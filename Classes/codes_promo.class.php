<?php

require_once('../Classes/bdd.class.php');
class codePromo extends bdd {

    public function ajouterCodePromo()
    {   
        $codePromo = htmlspecialchars($_POST["code"]);
        $valeurCode = htmlspecialchars($_POST["valeur"]);

        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM code_promo where code = :code");
        $req->bindValue('code', $codePromo, PDO::PARAM_STR);
        $req -> execute();
        $result = $req->fetchAll();

        var_dump($result);

        if (!empty($result)){
            echo "Le Code Promo indiqué figure déjà dans votre base de données, veuillez le renommer.";
            return false;
        }else{

            $req = $con->prepare("INSERT INTO code_promo (code, valeur_code) values (:code, :valeur)");
            $req->bindValue('code', $codePromo, PDO::PARAM_STR);
            $req->bindValue('valeur', $valeurCode, PDO::PARAM_STR);
            $req->execute();
            header("Refresh: 0");

        }

    }

    public function showCodePromo()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM code_promo");
        $req->execute();
        $result = $req -> fetchAll();

        echo "<h1>Codes Actifs :</h1><br />";
        foreach($result as $resultat){
            echo "Code : " . $resultat["code"] . "  |  Valeur : " . $resultat["valeur_code"] . "%<br /><br />";
        }

    }

    public function supprimerCodePromo()
    {
        $codePromo = $_POST["code_supp"];

        $con = $this->connectDb();
        $req = $con->prepare("DELETE FROM `code_promo` WHERE `code` = :code");
        $req->bindValue('code', $codePromo, PDO::PARAM_STR);
        $req -> execute();
        
        header('Refresh: 0');

    }

    public function testCode(){

        $prix = $_POST["prix"];
        $code = $_POST["code_test"];

        $con = $this->connectDb();
        $req = $con->prepare("SELECT valeur_code FROM code_promo where code = :code");
        $req->bindValue('code', $code, PDO::PARAM_STR);
        $req -> execute();
        $result = $req -> fetch();

        $valeur = $result['valeur_code'];

        $resultatF = $prix - 100 * $valeur;

        echo $resultatF;


    }
}


?>
