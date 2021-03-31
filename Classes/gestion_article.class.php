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
        
        //Traitement de l'image
        
        $Img = $_FILES["Img"]["name"];
        $img_Tmp = $_FILES["Img"]["tmp_name"];

        if(!empty($img_Tmp)){

            $img_Name = explode(".", $Img);
            $img_Ext = end($img_Name);

            if(in_array(strtolower($img_Ext),array("png", "jpg", "jpeg")) === false){

                echo "L'image insérée doit avoir pour extension : .png, .jpg, .jpeg";

            }else{

                $img_Size = getimagesize($img_Tmp);

                if($img_Size["mime"] == "image/jpeg"){

                    $img_Src = imagecreatefromjpeg($img_Tmp);

                }else if ($img_Size["mime"] == "image/png"){

                    $img_Src = imagecreatefrompng($img_Tmp);

                }else{

                    $img_Src = false;
                    echo "Veuillez rentrer une image valide";
                }

                if($img_Src !== false){

                    $img_Width = 1000;

                    if($img_Size[0] == $img_Width){

                        $img_Finale = $img_Src;

                    }else{

                        $new_Width[0] = $img_Width;

                        $new_Height[1] = 1000;

                        $img_Finale = imagecreatetruecolor($new_Width[0], $new_Height[1]);

                        imagecopyresampled($img_Finale, $img_Src, 0, 0, 0, 0, $new_Width[0], $new_Height[1], $img_Size[0], $img_Size[1]);

                    }

                    imagejpeg($img_Finale, "../StockageImg/" .addslashes($nomProduit). ".jpg");
                }
            }

        }else{
            echo "Veuillez insérer une image à votre Produit.";
        }
        
        //Fin du traitement de l'image

        // <!-- POUR AFFICHER L'IMAGE ON A JUSTE A FAIRE DANS NOTRE BOUCLE D'AFFICHAGE <img src="../StockageImg/php echo $result->nomProduit; .jpg"/>

        $con = $this->connectDb();
        $req = $con->prepare("INSERT INTO produits(nom, prix, description, id_categorie, id_sous_categorie, stock) values (:nom, :prix, :description, :id_categorie, :id_sous_categorie, :stock)");
        $req->bindValue("nom", $nomProduit, PDO::PARAM_STR);
        $req->bindValue("prix", $prixProduit, PDO::PARAM_STR);
        $req->bindValue("description", $descriptionProduit, PDO::PARAM_STR);
        $req->bindValue("id_categorie", $idCategorie, PDO::PARAM_INT);
        $req->bindValue("id_sous_categorie", $idSCategorie, PDO::PARAM_INT);
        $req->bindValue("stock", $stockProduit, PDO::PARAM_INT);
        
        $req->execute();
    }

    public function viewAllProduits()
    {
        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM produits");
        $request->execute();
        $result = $request -> fetchAll();

        echo "<table><thead>";
        echo "<th>Image Produit</th>";
        echo "<th>Id Produit</th>";
        echo "<th>Nom Produit</th>";
        echo "<th>Prix Produit</th>";
        echo "<th>Description Produit</th>";
        echo "<th>Id Catégorie</th>";
        echo "<th>Id Sous Catégorie</th>";
        echo "<th>N° en Stock</th>";
        echo "</thead><tbody>";
        foreach($result as $resultat){
        
        
            echo "<tr>";
            echo "<td><img src='../StockageImg/" . addslashes($resultat['nom']) .".jpg' width='100px' height='100px'/></td>";
            echo "<td>" . $resultat["id"] . "</td>";
            echo "<td>" . $resultat["nom"] . "</td>";
            echo "<td>" . $resultat["prix"] . "</td>";
            echo "<td>" . $resultat["description"] . "</td>";
            echo "<td>" . $resultat["id_categorie"] . "</td>";
            echo "<td>" . $resultat["id_sous_categorie"] . "</td>";
            echo "<td>" . $resultat["stock"] . "</td>";
            echo "<td><a href=''>Modifier Prdt.</a></td>";
            echo "<td><a href=''>Supprimer Prdt.</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";

    }

}

?>