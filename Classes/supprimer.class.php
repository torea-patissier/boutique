<?php
require_once('bdd.class.php');

class supprimer extends bdd{

    // Supprimer une adresse principale de la Bdd
    public function DeleteAdress(){
        if(isset($_GET['id']) AND !empty($_GET['id'])){
            $con = $this->connectDb();
            
            $id = $_GET['id'];

            $supp = $con->prepare("DELETE FROM adresse WHERE id = :id ");
            $supp->bindValue('id', $id, PDO::PARAM_INT);
            $supp->execute();
            header("Refresh: 0;url=http://localhost:8888/boutique/adresse/adresse.php");

        }
        
    }

        // Supprimer une adresse secondaire de la Bdd
    public function DeleteSecondaryAdress(){
        if(isset($_GET['id']) AND !empty($_GET['id'])){
            $con = $this->connectDb();
            
            $id = $_GET['id'];

            $supp = $con->prepare("DELETE FROM adresse2 WHERE id2 = :id ");
            $supp->bindValue('id', $id, PDO::PARAM_INT);
            $supp->execute();
            header("Refresh: 0;url=http://localhost:8888/boutique/adresse/adresse.php");
        }   
    }
}

?>