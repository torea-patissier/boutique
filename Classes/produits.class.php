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
            <div class="container">
            <div class="produit_s">
            <img src="../StockageImg/<?php echo $s->nom;?>.jpg" width="500px" height="500px"/>
            <p class="p_nom"><?php echo $s->nom;?>  </p>
            <p class="p_description"><?php echo $s->description;?></p>
            <p class="p_prix"><b><?php echo $s->prix;?>€</b></p>
            
            
            
            <?php

                if($s->stock > 10){ // Si le stock > 10 on affiche le produit, sinon on affiche la rupture de stock
            
                   ?> 
                    <!-- l=titre // q=1 par défaut car on ajoute 1 quantité au panier // p=prix -->
                    <a id="produits_ajoutPanier" class="waves-effect waves-light btn grey darken-4" href="panier.php?action=ajout&amp;l=<?php echo $s->nom;?>&amp;q=1&amp;p=<?php echo $s->prix;?>&amp;i=<?php echo $s->id?>">Ajouter au panier</a>
                    <!-- Dans ce href TOUT doit être collé -->
                    </div>
            </div>
                    <?php
                    }else{
                
                    echo ' <h3> Produit en rupture de stock </h3>';
                }

        }else{
            // ICI ON VERRA TOUS LES ARTICLES STOCKE EN BDD
            ?><div class="responsive"><?php 

            
            while ($r = $request->fetch(PDO::FETCH_OBJ)) { // Boucle while pour récup les éléments de produits
                ?>
                <!-- //Debut Grand Affichage  -->
                <?php
                $lenght = 50;// Cette $ pour limiter a 50 caractères le nb de lettres affiché pour la description
                $description = $r->description; // On stock dans une var 
                $new_description = substr($description,0,$lenght).'...';
                $descriptionFinale = wordwrap($new_description,100,'<br />',false); // ICI à chaque 100 caractères on revient à la ligne

            ?>


                
                <!-- On récupère l'ID d'un article pour l'ajouter à show -->

                    <div class="item">
                    <a href="?show=<?php echo $r->nom;?>"> <img src="../StockageImg/<?php echo $r->nom;?>.jpg" width="250px" height=" 250px"/></a><br />
                    <a href="?show=<?php echo $r->nom;?>"> <p class="pdt_nom_href"><?php echo $r->nom; ?></p></a>
                    <p class="pdts_prix"><b> <?php echo $r->prix; ?>€<b/></h5>
                    <br />



                
                <!-- HREF pour ajouter un produit au panier + redirection sur panier.php IL FAUT PRENDRE EN COMPTE QU'IL N Y A PAS D ESPACE -->
            
                <?php if($r->stock > 10){ // Si le stock > 10 on affiche le bouton d'ajout au panier, sinon on affiche la rupture de stock
                    ?>
                    <a class="btn black" href="panier.php?action=ajout&amp;l=<?php echo $r->nom;?>&amp;q=1&amp;p=<?php echo $r->prix;?>&amp;i=<?php echo $r->id?>">Ajouter au panier</a>
                    </div>

                    <br />
                    <br />
                    <br />
                    <?php
                }else{
                    echo '<h3> Produit en rupture de stock </h3>';
                }
                ?>
                </div>

                <!-- //Fin grand Affichage -->

                <!-- //Debut petit Affichage -->
                <div class="hide-on-large-only">
                <?php
                $lenght = 50;// Cette $ pour limiter a 50 caractères le nb de lettres affiché pour la description
                $description = $r->description; // On stock dans une var 
                $new_description = substr($description,0,$lenght).'...';
                $descriptionFinale = wordwrap($new_description,100,'<br />',false); // ICI à chaque 100 caractères on revient à la ligne

            ?>

            
                <!-- On récupère l'ID d'un article pour l'ajouter à show -->
                <a href="?show=<?php echo $r->nom;?>"> <img src="../StockageImg/<?php echo $r->nom;?>.jpg" width="250px" height=" 250px"/></a><br />
                <a href="?show=<?php echo $r->nom;?>"> <p class="pdt_nom_href"><?php echo $r->nom; ?></p></a>
                <p class="pdts_prix"><b> <?php echo $r->prix; ?>€<b/></h5>
                <br />

                <!-- HREF pour ajouter un produit au panier + redirection sur panier.php IL FAUT PRENDRE EN COMPTE QU'IL N Y A PAS D ESPACE -->
            
                <?php if($r->stock > 10){ // Si le stock > 10 on affiche le produit, sinon on affiche la rupture de stock
                    ?>
                    <a class="btn black" href="panier.php?action=ajout&amp;l=<?php echo $r->nom;?>&amp;q=1&amp;p=<?php echo $r->prix;?>&amp;i=<?php echo $r->id?>">Ajouter au panier</a>
                    <br />
                    <br />
                    <br />
                    <?php
                }else{
                    echo ' <h3> Produit en rupture de stock </h3>';
                }
                ?>
                </div></div>
                <?php
                // Fin Petit Affichage
            }
            ?>  <?php
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
                <img src="../StockageImg/<?php echo $r->nom;?>.jpg"/><br />
                <p class="p_nom"> <?php echo $r->nom; ?> </p>
                <p class="p_description"> <?php echo $r->description; ?> </p>
                <p class="p_prix"> <?php echo $r->prix; ?>€</p>
            <?php
            } ?>
        </div>
        <?php
    }
    
    // Fonction pour envoyer la commande en Bdd
    public function envoyerCommande($rand)
    { 
        $con = $this->connectDb();
        $id_client = $_SESSION['user']['id'];
        $date = date('Y-m-d H:i:s'); 

        // Dans ce foreach on va envoyer l'id de l'article dans l'historique, pour pouvoir récupérer par la suite, nom et prix de l'article
        foreach($_SESSION['panier']['idProduit'] as $valIdProduit){

            $req = $con->prepare("INSERT INTO commande(id_article, date, n_commande, id_client2) 
            VALUES ('$valIdProduit','$date','$rand','$id_client')");
            $req->execute();

        }
        // Dans celui-ci on va envoyer la quantité, l'id de quantité s'incrémente en  même temps que celui de id_article
        // On va pouvoir utiliser l'id pour récupérer la quantité et savoir quel quantité == quel article
        foreach($_SESSION['panier']['qteProduit'] as  $valqteProduit){
    
                $req = $con->prepare("INSERT INTO quantite(id_client, quantité, n_commande_qte)
                VALUES ('$id_client','$valqteProduit','$rand')");
                $req->execute();
        }
        
    }
              
    
    // Fonction pour envoyer le total de la commande en Bdd
    public function envoyerTotal($total,$rand){

        $id_client = $_SESSION['user']['id'];
        $date = date('Y-m-d H:i:s'); 
        $con = $this->connectDb();
        $req = $con->prepare("INSERT INTO total(id_client, total, date, n_commande) VALUES 
        ('$id_client','$total','$date','$rand')");
        $req->execute();

    }

    public function afficherCommande()
    {
        $con = $this->connectDb();

        $req = $con->prepare("SELECT * FROM commande INNER JOIN produits INNER JOIN
        quantite ON commande.id_article = produits.id AND
        quantite.id2 = commande.id1 WHERE id_client2 = '" . $_SESSION['user']['id'] . "' ");
        $req0 = $con->prepare("SELECT * FROM total WHERE id_client = '" . $_SESSION['user']['id'] . "' ");

        $req->execute();
        $req0->execute();

        $x = $req0->fetchAll();
        $r = $req->fetchAll();
        foreach($x as $resultat0){
            echo'<div class="container">';
            echo'<div class="tableCommande">';
            echo'<div class="row">';
            echo'<div class="col s12">';
            echo '<table class="striped"> <th> Commandé le ' . ' '  . $resultat0['date'] . ' | </th> 
            <th> Réf n º: ' . $resultat0['n_commande'] . ' |</th>';
            echo '<th>Total : ' . $resultat0['total'] . '€ </th> ';
            echo '<tr>';

            foreach($r as $resultat){
                if($resultat['n_commande'] == $resultat0['n_commande']){
                    echo '<td>' . $resultat['nom'] . ' x ' . $resultat['quantité'] .  '</td>  <br />';
                    echo ' <td><br />' . $resultat['prix'] .  '  € <br /> <br /> </td> ' ;
                ?>
                <td><img src="../Images/<?php echo $resultat['nom'] ;?>.jpg"/><br /><br /></td></tr>
                    <?php
               }
           }
           echo '</table>';
           echo "</div>";
           echo "</div>";
           echo "</div>";
           echo "</div><br />";
        }
    }
}

?>