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
                            <img src="Images/<?= $a['nom'] ?>.jpg" width="100" height="100px"><br />
                            <?= $a['nom']; ?> <br />
                            <?= $a['prix']; ?> € <br />
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
        ?>
        <form method="GET">
            <input type="search" name="q" placeholder="Recherche..." />
            <input type="submit" value="Valider" />
        </form>
<?php
    }
}
?>