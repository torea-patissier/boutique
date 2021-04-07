<?php
require_once('../Classes/bdd.class.php');

class gestion_article extends bdd{


    // Selectionner la catégorie en Bdd
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
    // Selectionner la Sous-catégorie en Bdd
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
    // Ajouter un produit en Bdd COMPREND LES IMAGES
    public function ajoutProduitBdd()
    {
            $nomProduit = htmlspecialchars($_POST['nom_produit']);
            $prixProduit = htmlspecialchars($_POST['prix_produit']);
            $descriptionProduit = htmlspecialchars($_POST['description_produit']);
            $idCategorie = htmlspecialchars($_POST['Categorie']);
            $idSCategorie = htmlspecialchars($_POST['SCategorie']);
            $stockProduit = htmlspecialchars($_POST['stock_produit']);
            //Insérer une image correspond au nom du produit dans le formulaire
            $img = $_FILES['img']['name'];
            // Image temporaire stocké 
            $img_tmp = $_FILES['img']['tmp_name'];

                if(!empty($img_tmp)){

                    $con = $this->connectDb();
                    $req = $con->prepare("INSERT INTO produits(nom, prix, description, id_categorie, id_sous_categorie, stock) values (:nom, :prix, :description, :id_categorie, :id_sous_categorie, :stock)");
                    $req->bindValue("nom", $nomProduit, PDO::PARAM_STR);
                    $req->bindValue("prix", $prixProduit, PDO::PARAM_STR);
                    $req->bindValue("description", $descriptionProduit, PDO::PARAM_STR);
                    $req->bindValue("id_categorie", $idCategorie, PDO::PARAM_INT);
                    $req->bindValue("id_sous_categorie", $idSCategorie, PDO::PARAM_INT);
                    $req->bindValue("stock", $stockProduit, PDO::PARAM_INT);
                    $req->execute();
                    //Crée un array avec $image[0] et $img[1] l'extension
                    $image = explode('.',$img); 
                    //Extension
                    $image_ext = end($image);


                    if(in_array(strtolower($image_ext),array('png','jpg','jpeg'))===false){
                        echo 'Veuillez rentrer une image au format png, jpg, jpeg';
                    }else{
                        $image_size = getimagesize($img_tmp);
                        // Le print_r renvoi Array ( [0] => 2400 [1] => 1600 [2] => 2 [3] => width="2400" height="1600" [bits] => 8 [channels] => 3 [mime] => image/jpeg )
                        // print_r($image_size);

                        // Si l'image est au format JPG ou JPEG
                        if($image_size['mime'] == 'image/jpeg'){
                            // On attribut à la $image_src le format JPEG
                            $image_src = imagecreatefromjpeg($img_tmp);

                        // Si l'image est au format PNG
                        }elseif($image_size['mime'] == 'image/png'){

                            // On attribut à la $image_src le format PNG
                            $image_src = imagecreatefrompng($img_tmp);

                        }else{
                            // Si c'est un autre format on renvoi false;
                            $image_src = false;
                            echo'Veuillez rentrer une image valide';

                        }

                        // Redimension de l'image en 400x400
                        if($image_src !== false){

                            $image_width = 400;

                            if($image_size[0] == $image_width){

                                $image_finale = $image_src;

                            }else{

                                $new_width[0] = $image_width;

                                $new_height[1] = 400;

                                $image_finale = imagecreatetruecolor($new_width[0],$new_height[1]);

                                imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width[0],$new_height[1],$image_size[0],$image_size[1]);
                            }
                        }
                        imagejpeg($image_finale,'../Images/' . $nomProduit . '.jpg');

                    }
                
                }else{

                    echo 'Veuillez rentrer une image <br /> <br />';
                    return false;
                }


    }

    // Pour voir/ modifier/ supprimer un article en Bdd
    public function viewModifyDeleteArticle()
    {
        // Connexion classique à la Bdd
        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM produits");
        $request->execute();

        // Permet d'afficher un lien pour modifier ou supprimer un article en Bdd 
        // Plus sympa que la boucle FOR
        while($r = $request->fetch(PDO::FETCH_OBJ)){
            echo $r->nom;
            echo $r->prix;
            echo $r->description;
            echo $r->id;
            ?> 
            <a href="?action=modify&amp;id=<?php echo $r->id; ?>">Modifier</a>
            <a href="?action=delete&amp;id=<?php echo $r->id; ?>">Supprimer</a><br/><br />
            <?php 
        }
        // Supprimer un article de la Bdd
        if(isset($_GET['action'])&&($_GET['action']== 'delete')){
            $id = $_GET['id'];
            $req = $con->prepare("DELETE FROM produits WHERE id = '". $id ."' ");
            $req->execute();
            header("Location://localhost:8888/boutique/Gestion_article/gestion_article.php");
        }


        // Modifier un article en Bdd si on appuie sur le bouton modifier
        if(isset($_GET['action'])&&($_GET['action']== 'modify')){

            $id = $_GET['id'];
            // Si on appuie sur modifier
            if(isset($_POST['envoyer'])){
                
                $nom = $_POST['nom'];
                $description = $_POST['description'];
                $prix = $_POST['prix'];
                $id_categorie = $_POST['id_categorie'];
                $id_sous_categorie = $_POST['id_sous_categorie'];
                $stock = $_POST['stock'];

                // Requête de modification
                //UPDATE produits SET nom = 'coco', prix = 10, description = 'Oui', id_categorie = 21, id_sous_categorie = 22, stock = 23, chemin_image = 0 WHERE id = 36

                $update = $con->prepare("UPDATE produits SET nom = '$nom', prix = $prix, description = '$description', id_categorie = $id_categorie, id_sous_categorie = $id_sous_categorie, stock = $stock WHERE id = '" . $id . "' ");
                $update->execute(); 
                header("location:gestion_article.php");


            }

            
            // Afficher le formulaire de modification avec les valeurs de la Bdd en VALUE
            $select = $con->prepare("SELECT * FROM produits WHERE id = '" . $id . "' ");
            $select->execute();

            $data = $select->fetch(PDO::FETCH_OBJ); 

            ?>
            <form action="" method="post">
            <label>Titre :</label><br/><br />
            <input type="text" name="nom" value="<?php echo $data->nom;?>"><br/><br />

            <label>Description :</label><br/><br />
            <textarea name="description" rows="4" cols="50"><?php echo $data->description;?></textarea><br/><br />

            <label>Prix :</label><br/><br />
            <input type="text" name="prix" value="<?php echo $data->prix;?>"><br/><br />

            <label>ID Categorie :</label><br/><br />
            <input type="text" name="id_categorie" value="<?php echo $data->id_categorie;?>"><br/><br />

            <label>ID Sous-catégorie :</label><br/><br />
            <input type="text" name="id_sous_categorie" value="<?php echo $data->id_sous_categorie;?>"><br/><br />

            <label>Stock :</label><br/><br />
            <input type="text" name="stock" value="<?php echo $data->stock;?>"><br/><br />

            <input type="submit" name="envoyer" value="Modifier"><br/><br />
            </form>
            <?php
        }
    }

}
?>