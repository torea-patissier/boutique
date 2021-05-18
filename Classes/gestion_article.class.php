<?php
require_once('../Classes/bdd.class.php');

class gestion_article extends bdd{

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

                    imagejpeg($img_Finale, "../Images/" .addslashes($nomProduit). ".jpg");
                }
            }

        }else{
            echo "Veuillez insérer une image à votre Produit.";
        }
        
        //Fin du traitement de l'image

        // <!-- POUR AFFICHER L'IMAGE ON A JUSTE A FAIRE DANS NOTRE BOUCLE D'AFFICHAGE <img src="../Images/php echo $result->nomProduit; .jpg"/>

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
        echo "<br /><br /><br />";
        echo "<div class='rox'>";
        echo "<table class='responsive-table' ><thead>";
        echo "<th>Image Produit</th>";
        echo "<th>Nom Produit</th>";
        echo "<th>Prix Produit</th>";
        echo '<th class="hide-on-med-and-down">Description Produit</th>';
        echo "<th>Id Catégorie</th>";
        echo "<th>Id Sous Catégorie</th>";
        echo "<th>N° en Stock</th>";
        echo "</thead><tbody>";
        while($r = $request->fetch(PDO::FETCH_OBJ)){
        
        
            echo "<tr>";
            echo "<td><img src='../Images/" . addslashes($r->nom) .".jpg' width='100px' height='100px'/></td>";
            echo "<td>" . $r->nom . "</td>";
            echo "<td>" . $r->prix . "€</td>";
            echo "<td class='hide-on-med-and-down'>" . $r->description . "</td>";
            echo "<td>" . $r->id_categorie . "</td>";
            echo "<td>" . $r->id_sous_categorie . "</td>";
            echo "<td>" . $r->stock . "</td>";
            echo "<td><a href='?show=" . $r->id . "'>Modifier</a><br/>";
            echo "<a href='?action=delete&amp;id=" . $r->id . "'>Supprimer</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table></div>";
    }

    public function ModifierProduit()
    {   
            $id = $_GET["show"];
            $con = $this->connectDb();
            $product = htmlspecialchars($_GET['show']);
            $request = $con->prepare("SELECT * FROM produits WHERE id = :id"); // Requête SQL
            $request->bindValue("id", $id, PDO::PARAM_INT);
            $request->execute(); // On execute

            $s = $request->fetch(PDO::FETCH_OBJ);  // Résultat stocké dans la $S

            ?> 
            <br /><br /><br />
                <div class="container">
                    <div class="center-align">
                        <img class="hide-on-small-only" src="../Images/<?php echo $s->nom;?>.jpg" width="500px" height="500px"/><br/><br/>
                        <img class="hide-on-med-and-up" src="../Images/<?php echo $s->nom;?>.jpg" width="290px" height="290px"/><br/><br/>
                    </div>
            <div class="row">
            <form id='modifierArticle' class="col s12" action="" method="post">
                <div class="input-field col s12 m4 l4">
                    <label>Titre :</label><br/><br />
                    <input type="text" name="nom" value="<?php echo $s->nom;?>"><br/><br />
                </div>
                <div class="input-field col s12 m4 l4">
                <label>Description :</label><br/><br />
                <textarea name="description" rows="4" cols="50"><?php echo $s->description;?></textarea><br/><br />
                </div>

                <div class="input-field col s12 m4 l4">
                <label>Prix :</label><br/><br />
                <input type="text" name="prix" value="<?php echo $s->prix;?>"><br/><br />
                </div>

                <div class="input-field col s12 m4 l4">
                <label>ID Categorie :</label><br/><br />
                <input type="text" name="id_categorie" value="<?php echo $s->id_categorie;?>"><br/><br />
                </div>

                <div class="input-field col s12 m4 l4">
                <label>ID Sous-catégorie :</label><br/><br />
                <input type="text" name="id_sous_categorie" value="<?php echo $s->id_sous_categorie;?>"><br/><br />
                </div>

                <div class="input-field col s12 m4 l4">
                <label>Stock :</label><br/><br />
                <input type="text" name="stock" value="<?php echo $s->stock;?>"><br/><br />
                </div><br/>

                <input class="btn black center-align" type="submit" name="envoyer" value="Modifier"><br/><br />
            </form>
            </div>
            </div>

            <?php
            // Si on appuie sur modifier
            if(isset($_POST['envoyer'])){
                

                $nom = htmlspecialchars(addslashes($_POST['nom']));
                $description = htmlspecialchars(addslashes($_POST['description']));
                $prix = htmlspecialchars($_POST['prix']);
                $id_categorie = htmlspecialchars($_POST['id_categorie']);
                $id_sous_categorie = htmlspecialchars($_POST['id_sous_categorie']);
                $stock = htmlspecialchars($_POST['stock']);

                // Requête de modification
                //UPDATE produits SET nom = 'coco', prix = 10, description = 'Oui', id_categorie = 21, id_sous_categorie = 22, stock = 23, chemin_image = 0 WHERE id = 36

                $update = $con->prepare("UPDATE produits SET nom = :nom, prix = :prix, description = :description, id_categorie = :id_categorie,
                 id_sous_categorie = :id_sous_categorie, stock = :stock WHERE id = :id ");
                $update->bindValue("nom", $nom, PDO::PARAM_STR);
                $update->bindValue("prix", $prix, PDO::PARAM_INT);
                $update->bindValue("description", $description, PDO::PARAM_STR);
                $update->bindValue("id_categorie", $id_categorie, PDO::PARAM_INT);
                $update->bindValue("id_sous_categorie", $id_sous_categorie, PDO::PARAM_INT);
                $update->bindValue("stock", $stock, PDO::PARAM_INT);
                $update->bindValue("id", $id, PDO::PARAM_INT);
                $update->execute();

                //REFRESH / HEADER LOCATION AVEC JAVASCRIPT
                $pageGestion = new gestion_article;
                echo '<script language="Javascript"> document.location.replace("http://localhost/boutique/Gestion_article/gestion_article.php"); </script>';
                $pageGestion -> viewAllProduits();




            }
    }

    public function DeleteProduit(){
        $con = $this->connectDb();

                // Supprimer un article de la Bdd
                if(isset($_GET['action'])&&($_GET['action']== 'delete')){
                    $id = htmlspecialchars($_GET['id']);
                    $req = $con->prepare("DELETE FROM produits WHERE id = :id ");
                    $req->bindValue("id", $id, PDO::PARAM_INT);
                    $req->execute(); 
                    header('location:http://localhost/boutique/Gestion_article/gestion_article.php');
                }
    }

}

?>