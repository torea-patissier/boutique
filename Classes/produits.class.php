<?php
require_once('../Classes/bdd.class.php');
class produits extends bdd
{

    public function showArticles()
    {
        $con = $this->connectDb();
        $request = $con->prepare("SELECT * FROM produits");
        $request->execute();

        while ($r = $request->fetch(PDO::FETCH_OBJ)) {

?>
            <h2>Nom: <?php echo $r->nom; ?> </h2>
            <h3>Description: <?php echo $r->description; ?> </h3>
            <h4>Prix: <?php echo $r->prix; ?>€</h4>
            <hr>
        <?php
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
            <h3>Derniers articles :</h3>
            <?php
            while ($r = $request->fetch(PDO::FETCH_OBJ)) {
                echo $r->nom;
                echo $r->description;
                echo $r->prix;

            ?>
                <h2> <?php echo $r->nom; ?> </h2>
                <h4> <?php echo $r->description; ?> </h4>
                <h5> <?php echo $r->prix; ?> </h5>
            <?php
            } ?>
        </div>
<?php
    }
}
?>