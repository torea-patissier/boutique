<?php
require_once('../Classes/bdd.class.php');
class produits extends bdd
{
    // Montrer les articles stocké en Bdd avec la possibilité d'en selectionner un pour en afficher QU'UN SEUL
    public function showArticles()
    {
        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM produits");
        $request->execute();
        // ICI ON VERRA CE QUE CONTIENT UNE SEUL ARTICLE
        // Si on appuie sur show
        if(isset($_GET['show'])){

            $product = $_GET['show'];             // GET stocké dans une variable
            $request = $con->prepare("SELECT * FROM produits WHERE nom = '" . $product . "' "); // Requête SQL
            $request->execute(); // On execute

            $s = $request->fetch(PDO::FETCH_OBJ);  // Résultat stocké dans la $S

            ?>
            <img src="../Images/<?php echo $s->nom;?>.jpg"/>
            <h1>Nom : <?php echo $s->nom;?>  </h1>
            <h2>Description : <?php echo $s->description;?></h2>
            <h3> Prix :<?php echo $s->prix;?>€</h3>
            <h4> Stock :<?php echo $s->stock;?></h4>
            
            <?php
                
                if($s->stock > 10){ // Si le stock > 10 on affiche le produit, sinon on affiche la rupture de stock
            
                   ?> 
                    <!-- l=titre // q=1 par défaut car on ajoute 1 quantité au panier // p=prix -->
                    <a href="panier.php?action=ajout&amp;l=<?php echo $s->nom;?>&amp;q=1&amp;p=<?php echo $s->prix;?>">Ajouter au panier</a>
                    <!-- Dans ce href TOUT doit être collé -->
                    <hr>
                    <?php
                    }else{
                
                    echo ' <h3> Produit en rupture de stock </h3>';
                }

        }else{
            // ICI ON VERRA TOUS LES ARTICLES STOCKE EN BDD

            while ($r = $request->fetch(PDO::FETCH_OBJ)) { // Boucle while pour récup les éléments de produits

                
                $lenght = 50;// Cette $ pour limiter a 50 caractères le nb de lettres affiché pour la description
                $description = $r->description; // On stock dans une var 
                $new_description = substr($description,0,$lenght).'...';
                $descriptionFinale = wordwrap($new_description,100,'<br />',false); // ICI à chaque 100 caractères on revient à la ligne

            ?>
                <!-- On récupère l'ID d'un article pour l'ajouter à show -->
                <a href="?show=<?php echo $r->nom;?>"> <img src="../Images/<?php echo $r->nom;?>.jpg"/></a><br />
                <a href="?show=<?php echo $r->nom;?>"> <h2><?php echo $r->nom; ?></h2></a>
                <h4> <?php echo $descriptionFinale; ?> </h4>
                <h5> <?php echo $r->prix; ?>€</h5>
                <!-- HREF pour ajouter un produit au panier + redirection sur panier.php IL FAUT PRENDRE EN COMPTE QU'IL N Y A PAS D ESPACE -->
            
                <?php if($r->stock > 10){ // Si le stock > 10 on affiche le produit, sinon on affiche la rupture de stock
                    ?>
                    <a href="panier.php?action=ajout&amp;l=<?php echo $r->nom;?>&amp;q=1&amp;p=<?php echo $r->prix;?>">Ajouter au panier</a>
                    <hr>
                    <?php
                }else{
                    echo ' <h3> Produit en rupture de stock </h3>';
                }
            }
        }
    }

    //Montrer au client les derniers articles ajoutés en Bdd (nouveautés)
    public function newArticles()
    {

        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT 0,3");
        $request->execute();
        ?>
        <div class="sidebar">
            <h1>Derniers articles :</h1>
            <?php
            while ($r = $request->fetch(PDO::FETCH_OBJ)) {
            ?>
                <img src="../Images/<?php echo $r->nom;?>.jpg"/><br />
                <h2> <?php echo $r->nom; ?> </h2>
                <h4> <?php echo $r->description; ?> </h4>
                <h5> <?php echo $r->prix; ?>€</h5>
            <?php
            } ?>
        </div>
        <?php
    } 

    public function envoyerCommande($nom_article,$qteProduit)
    {   
        $con = $this->connectDb();

        $panier = $_SESSION['panier'];
        $libelleProduit = $_SESSION['panier']['libelleProduit'];
        $qteProduit = $_SESSION['panier']['qteProduit'];
        $prixProduit = $_SESSION['panier']['prixProduit'];
        $id = $_SESSION['user']['id'];
        echo'<pre>';
        // var_dump($panier['libelleProduit']);
        echo'</pre>';

        // foreach($libelleProduit as $x){

        //     $nom_article = $x;
        //     echo'<pre>';
        //     var_dump($nom_article);
        //     echo'</pre>';
        // }

        // foreach($qteProduit as $y){

        //     $a = $y;     
        //     echo'<pre>';
        //     var_dump($a);
        //     echo'</pre>';                        
        // }


        // for($i = 0; $i <= $panier; $i++){

        //     var_dump($panier[$i]);

        // }

        $req = $con->prepare("INSERT INTO `historique_achat`(id_client, nom_article, quantite) VALUES ('$id','$nom_article', '$qteProduit')");
        $req->execute();
    }

    public function insertcommande($id, $nom_article,$qteProduit)
    {
        $id = $_SESSION['user']['id'];


        $con = $this->connectDb();
        $req = $con->query("INSERT INTO historique_achat (id_client, nom_article, quantite) VALUE( ?, ?, ?)", [$id, $nom_article,$qteProduit]);

    }
}
?>
