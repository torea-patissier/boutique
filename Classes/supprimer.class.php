<?php
require_once('bdd.class.php');

class supprimer extends bdd{

    public function DeleteAdress(){
        if(isset($_GET['id']) AND !empty($_GET['id'])){
            $con = $this->connectDb();
            
            $id = $_GET['id'];

            $supp = $con->prepare("DELETE FROM adresse WHERE id_client = :id ");
            $supp->bindValue('id', $id, PDO::PARAM_INT);
            $supp->execute();

        }
        
    }
}

?>