<?php

require_once('../Classes/bdd.class.php');

class index extends bdd{
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

}