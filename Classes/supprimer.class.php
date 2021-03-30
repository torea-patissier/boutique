<?php
require_once('bdd.class.php');

class supprimer extends bdd{

    // Supprimer une adresse principale de la Bdd
    public function DeleteAdress(){
        if(isset($_GET['id']) AND !empty($_GET['id'])){
            $con = $this->connectDb();
            
            $id = $_GET['id'];

            $supp00 = $con->prepare("DELETE FROM adresse WHERE id = :id ");
            $supp00->bindValue('id', $id, PDO::PARAM_INT);
            $supp00->execute();
            header('location:http://localhost:8888/boutique/Adresse/adresse.php');
        }
        
    }

        // Supprimer une adresse secondaire de la Bdd
    public function DeleteSecondaryAdress(){
        if(isset($_GET['id']) AND !empty($_GET['id'])){
            $con = $this->connectDb();
            
            $id = $_GET['id'];

            $supp11 = $con->prepare("DELETE FROM adresse2 WHERE id2 = :id ");
            $supp11->bindValue('id', $id, PDO::PARAM_INT);
            $supp11->execute();
            header('location:http://localhost:8888/boutique/Adresse/adresse.php');
        }   
    }
}

?>