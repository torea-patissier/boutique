<?php
require_once('bdd.class.php');

class Delete extends bdd{

    public function DeleteArticle(){
        if(isset($_GET['id']) AND !empty($_GET['id'])){
            $con = $this->connectDb();
            $sup_id = $_GET['id'];
            $supp = $con->prepare("DELETE FROM produits WHERE id = :supId ");
            $supp->bindValue('supId', $sup_id, PDO::PARAM_INT);
            $supp2 = $con->prepare("DELETE FROM categories WHERE id = :supId ");
            $supp2->bindValue('supId', $sup_id, PDO::PARAM_INT);
            $supp4 = $con->prepare("DELETE FROM sous_categories WHERE id = :supId ");
            $supp4->bindValue('supId', $sup_id, PDO::PARAM_INT);
            $supp3 = $con->prepare("DELETE FROM info_client WHERE id = :supId ");
            $supp3->bindValue('supId', $sup_id, PDO::PARAM_INT);

            $supp->execute();
            $supp2->execute();
            $supp3->execute();
            $supp4->execute();

            header('location:http://localhost/boutique/Admin/admin.php');
        
        }
        
    }
}

?>