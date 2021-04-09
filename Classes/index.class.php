<?php

require_once('Classes/bdd.class.php');

class index extends bdd{
//Montrer au client les derniers articles ajoutés en Bdd (nouveautés)
    public function lastArticles()
    {

        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT 0,3");
        $request->execute();
        ?>
            <?php
            while ($r = $request->fetch(PDO::FETCH_OBJ)) {
                $lenght = 300;// Cette $ pour limiter a 50 caractères le nb de lettres affiché pour la description
                $description = $r->description; // On stock dans une var 
                $new_description = substr($description,0,$lenght).'...';
                $descriptionFinale = wordwrap($new_description,50,'<br />',false); // ICI à chaque 100 caractères on revient à la ligne
            ?>
                <a class="noLignes" href="http://localhost/boutique/produit.php">
                <div class="lastProduit">
                <img src="StockageImg/<?php echo $r->nom;?>.jpg" width="300" height="300"/><br />
                <h2> <?php echo $r->nom; ?> </h2>
                <h4> <?php echo $descriptionFinale; ?> </h4>
                <h5> <?php echo $r->prix; ?>€</h5>
                </div>
                </a>
            <?php
            }?>
            
<?php
    }

    public function produitPhare()
    {
        
    }

    public function Recherche()
    {
        $con = $this->connectDb();
        $articles = $con->query('SELECT * FROM produits ORDER BY id DESC');

        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = htmlspecialchars($_GET['q']);
            $articles = $con->query('SELECT * FROM produits WHERE nom LIKE "%' . $q . '%" ORDER BY id DESC');
            if($articles->rowCount() == 0){
                $articles = $con->query('SELECT * FROM produits WHERE CONCAT(nom, description) LIKE "%' . $q . '%" ORDER BY id DESC');
            }
        }

        if($articles->rowCount() > 0){
            ?>
            <ul>
            <?php while($a = $articles->fetch()){
                
                if(!empty($q)){ ?>

                    <li>
                    <a href="../Produits/produits.php?show=<?=$a['nom']?>"><img src="StockageImg/<?= $a['nom']?>.jpg" width="50" height="50">    <?= $a['nom']?> <br /> <?= $a['prix']?>€</a>
                    </li>

                        <?php
                }
            }
            ?>
            </ul>
            <?php
        }else{
            echo 'Aucun résultat pour : '.$q;
        }
        ?>
            <form method="GET">
                <input type="search" name="q" placeholder="Recherche..." />
                <input type="submit" value="Valider" />
            </form>
        <?php
    }
}

?>