<?php
require_once('bdd.class.php');
class index extends bdd
{
    public function Recherche()
    {
        $con = $this->connectDb();
        $articles = $con->query('SELECT * FROM produits ORDER BY id DESC');

        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = htmlspecialchars($_GET['q']);
            $articles = $con->query('SELECT * FROM produits WHERE nom LIKE "%' . $q . '%" ORDER BY id DESC');
            if ($articles->rowCount() == 0) {
                $articles = $con->query('SELECT * FROM produits WHERE CONCAT(nom, description) LIKE "%' . $q . '%" ORDER BY id DESC');
            }
        }

        if ($articles->rowCount() > 0) {
?>
            <ul>
                <?php while ($a = $articles->fetch()) {

                    if (!empty($q)) { ?>

                        <li>
                            <a href="../boutique/Produits/produits.php?show=<?= $a['nom'] ?>"><br />
                                <img src="Images/<?= $a['nom'] ?>.jpg" width="200px" height="200px"><br />
                                <?= $a['nom']; ?> <br />
                                <?= $a['prix']; ?> € <br /></a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        <?php
        } else {
            echo 'Aucun résultat pour : ' . $q;
        }

        ?><br /><br />
        <form method="GET">
            <input type="search" name="q" placeholder="Recherche..." />
            <input class="btn black" type="submit" value="Valider" /><br />
        </form><br />
    <?php
    }

    public function lastArticles()
    {
        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM produits ORDER BY id DESC limit 0,3");
        $request->execute();
        // ICI ON VERRA CE QUE CONTIENT UNE SEUL ARTICLE
        // Si on appuie sur show
    ?>
        <div class="container">
            <div id="ProduitsIndex">
                <?php
                if (isset($_GET['show'])) {

                    $product = $_GET['show'];             // GET stocké dans une variable
                    $request = $con->prepare("SELECT * FROM produits WHERE nom = '" . $product . "' "); // Requête SQL
                    $request->execute(); // On execute

                    $s = $request->fetch(PDO::FETCH_OBJ);  // Résultat stocké dans la $S

                ?>
                    <img src="Images/<?php echo $s->nom; ?>.jpg"  width="200px" height="200px" /><br /><br />
                    <p>Nom : <?php echo $s->nom; ?> </p><br />
                    <h2>Description : <?php echo $s->description; ?></h2>
                    <h3> Prix :<?php echo $s->prix; ?>€</h3>
                    <h4> Stock :<?php echo $s->stock; ?></h4>
                    <?php

                    if ($s->stock > 10) { // Si le stock > 10 on affiche le produit, sinon on affiche la rupture de stock

                    ?>
                        <!-- l=titre // q=1 par défaut car on ajoute 1 quantité au panier // p=prix -->
                        <a href="Produits/panier.php?action=ajout&amp;l=<?php echo $s->nom; ?>&amp;q=1&amp;p=<?php echo $s->prix; ?>&amp;i=<?php echo $s->id ?>">Ajouter au panier</a>
                        <!-- Dans ce href TOUT doit être collé -->
                    <?php
                    } else {

                        echo ' <h3> Produit en rupture de stock </h3>';
                    }
                } else {
                    // ICI ON VERRA TOUS LES ARTICLES STOCKE EN BDD
                    while ($r = $request->fetch(PDO::FETCH_OBJ)) { // Boucle while pour récup les éléments de produits
                    ?>
                        <!-- On récupère l'ID d'un article pour l'ajouter à show -->
                        <div class="hide-on-small-only">
                            <div id="pIndex">
                                        <a href="Produits/produits.php?show=<?php echo $r->nom; ?>"><img src="Images/<?php echo $r->nom; ?>.jpg"  width="200px" height="200px"/></a>
                                        <a href="Produits/produits.php?show=<?php echo $r->nom; ?>">
                                            <h3><?php echo $r->nom; ?></h3>
                                        </a>
                                        <h4> <?php echo $r->prix; ?>€</h4>
                                        <!-- HREF pour ajouter un produit au panier + redirection sur panier.php IL FAUT PRENDRE EN COMPTE QU'IL N Y A PAS D ESPACE -->

                                        <?php if ($r->stock > 10) { // Si le stock > 10 on affiche le produit, sinon on affiche la rupture de stock
                                        ?>
                                            <a class="btn black" href="Produits/panier.php?action=ajout&amp;l=<?php echo $r->nom; ?>&amp;q=1&amp;p=<?php echo $r->prix; ?>&amp;i=<?php echo $r->id ?>"><i class="material-icons">shopping_cart</i> Ajouter au panier</a>
                            </div>
                        </div>
            <?php
                                        } else {
                                            echo ' <h3> Produit en rupture de stock </h3>';
                                        }
                                    }
                                }
            ?>
            </div>
        </div><br /><br />
<?php
    }

    public function lastArticles2()
    {
        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM produits ORDER BY id DESC limit 0,3");
        $request->execute();
        // ICI ON VERRA CE QUE CONTIENT UNE SEUL ARTICLE
        // Si on appuie sur show
    ?>
        <div class="container">
                <?php
                if (isset($_GET['show'])) {

                    $product = $_GET['show'];             // GET stocké dans une variable
                    $request = $con->prepare("SELECT * FROM produits WHERE nom = '" . $product . "' "); // Requête SQL
                    $request->execute(); // On execute

                    $s = $request->fetch(PDO::FETCH_OBJ);  // Résultat stocké dans la $S

                ?>
                    <img src="Images/<?php echo $s->nom; ?>.jpg"  width="200px" height="200px"/><br /><br />
                    <p>Nom : <?php echo $s->nom; ?> </p><br />
                    <h2>Description : <?php echo $s->description; ?></h2>
                    <h3> Prix :<?php echo $s->prix; ?>€</h3>
                    <h4> Stock :<?php echo $s->stock; ?></h4>
                    <?php

                    if ($s->stock > 10) { // Si le stock > 10 on affiche le produit, sinon on affiche la rupture de stock

                    ?>
                        <!-- l=titre // q=1 par défaut car on ajoute 1 quantité au panier // p=prix -->
                        <a href="Produits/panier.php?action=ajout&amp;l=<?php echo $s->nom; ?>&amp;q=1&amp;p=<?php echo $s->prix; ?>&amp;i=<?php echo $s->id ?>">Ajouter au panier</a>
                        <!-- Dans ce href TOUT doit être collé -->
                    <?php
                    } else {

                        echo ' <h3> Produit en rupture de stock </h3>';
                    }
                } else {
                    // ICI ON VERRA TOUS LES ARTICLES STOCKE EN BDD
                    while ($r = $request->fetch(PDO::FETCH_OBJ)) { // Boucle while pour récup les éléments de produits
                    ?>
                        <!-- On récupère l'ID d'un article pour l'ajouter à show -->
                        <div class="hide-on-med-and-up">
                            <div class="center-align">
                                        <a href="Produits/produits.php?show=<?php echo $r->nom; ?>"><img src="Images/<?php echo $r->nom; ?>.jpg"  width="200px" height="200px"/></a>
                                        <a href="Produits/produits.php?show=<?php echo $r->nom; ?>">
                                            <h3><?php echo $r->nom; ?></h3>
                                        </a>
                                        <h4> <?php echo $r->prix; ?>€</h4>
                                        <!-- HREF pour ajouter un produit au panier + redirection sur panier.php IL FAUT PRENDRE EN COMPTE QU'IL N Y A PAS D ESPACE -->

                                        <?php if ($r->stock > 10) { // Si le stock > 10 on affiche le produit, sinon on affiche la rupture de stock
                                        ?>
                                            <a class="btn black" href="Produits/panier.php?action=ajout&amp;l=<?php echo $r->nom; ?>&amp;q=1&amp;p=<?php echo $r->prix; ?>&amp;i=<?php echo $r->id ?>"><i class="material-icons">shopping_cart</i> Ajouter au panier</a>
                            </div></div><br />
            <?php
                                        }
                                    }
                                }
            ?>
            </div>
        <br /><br /><br />
<?php
    }

}
?>