<?php
require_once('../Classes/bdd.class.php');

class GestionProduit extends bdd{

    public function ajoutImgArticle()
    {
        $con = $this->connectDb();
        $req = $con->prepare("INSERT INTO image_produit (nom, taille, type, bin, id_produit) values(?, ?, ?, ?, 0)");
        $req->execute(array($_FILES["img"]["name"], $_FILES["img"]["size"], $_FILES["img"]["type"], file_get_contents($_FILES["img"]["tmp_name"])));
    }
}