<?php
require_once('bdd.class.php');

class adresses extends bdd
{
    // Afficher le formulaire Adresse principale

    public function ShowMainAdresse()
    {
        $id_client = $_SESSION['user']['id'];
        $con = $this->connectDb();
        $req = "SELECT * FROM adresse WHERE id_client = :id_client";
        $stmt = $con->prepare($req);
        $stmt->bindValue('id_client', $id_client, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if ($result != null) {
            echo 'Pour modifier votre adresse principale actuelle vous devez supprimer l\'ancienne';
            return false;
        } else {

            echo '
    <h3>Ajouter une adresse principale</h3>
    <form action="adresse.php" method="POST">
    
    <label>Adresse :</label><br />
    <input class="zonetxt_profil" type="text" name="adresse" required><br /><br />
    
    <label>Code Postal :</label><br />
    <input class="zonetxt_profil" type="number" name="code_postal" required><br /><br />
    
    <label>Ville :</label><br />
    <input class="zonetxt_profil" type="text" name="ville"required><br /><br />
    <input class="button-profil2" type="submit" name="envoyer" value="Ajouter mon adresse">
    </form>';
        }
    }



    // Afficher le formulaire Adresse secondaire

    public function ShowSecondaryAdress()
    {
        $id_client = $_SESSION['user']['id'];
        $con = $this->connectDb();
        $req = "SELECT * FROM adresse2 WHERE id_client2 = :id_client";
        $stmt = $con->prepare($req);
        $stmt->bindValue('id_client', $id_client, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $count = count($result);

        if ($count < 1) {

            echo '
    <h3>Ajouter une adresse secondaire</h3>
    <form action="adresse.php" method="POST">
    
    <label>Adresse :</label><br />
    <input class="zonetxt_profil" type="text" name="adresse2" required><br /><br />
    
    <label>Code Postal :</label><br />
    <input class="zonetxt_profil" type="number" name="code_postal2" required><br /><br />
    
    <label>Ville :</label><br />
    <input class="zonetxt_profil" type="text" name="ville2"required><br /><br />
    
    <input class="button-profil2" type="submit" name="envoyer2" value="Ajouter mon adresse">
    
    </form>';
        } else {
            echo 'Vous avez droit à une seule adresse secondaire';
            return false;
        }
    }


    //Ajouter une adresse en Bdd

    public function AddAdress()
    {
        if (isset($_POST['envoyer']) && !empty('envoyer')) {
            $con = $this->connectDb();
            $adresse = htmlspecialchars($_POST['adresse']);
            $code_postal = htmlspecialchars($_POST['code_postal']);
            $ville = htmlspecialchars($_POST['ville']);
            $id_client = $_SESSION['user']['id'];

            $infoAdress = $con->prepare("INSERT INTO adresse (adresse, code_postal, ville, id_client) VALUES (:adresse, :code_postal, :ville, :id_client)");
            $infoAdress->bindValue('adresse', $adresse, PDO::PARAM_STR);
            $infoAdress->bindValue('code_postal', $code_postal, PDO::PARAM_INT);
            $infoAdress->bindValue('ville', $ville, PDO::PARAM_STR);
            $infoAdress->bindValue('id_client', $id_client, PDO::PARAM_INT);
            $infoAdress->execute();
            header("Refresh:0");
        } else {
            echo 'Erreur';
            return FALSE;
        }
    }


    //Ajouter une adresse2 en Bdd
    public function AddAdress2()
    {
        if (isset($_POST['envoyer2']) && !empty('envoyer2')) {
            $con = $this->connectDb();
            $adresse = htmlspecialchars($_POST['adresse2']);
            $code_postal = htmlspecialchars($_POST['code_postal2']);
            $ville = htmlspecialchars($_POST['ville2']);
            $id_client = $_SESSION['user']['id'];

            $infoAdress = $con->prepare("INSERT INTO adresse2 (adresse2, code_postal2, ville2, id_client2) VALUES (:adresse, :code_postal, :ville, :id_client)");
            $infoAdress->bindValue('adresse', $adresse, PDO::PARAM_STR);
            $infoAdress->bindValue('code_postal', $code_postal, PDO::PARAM_INT);
            $infoAdress->bindValue('ville', $ville, PDO::PARAM_STR);
            $infoAdress->bindValue('id_client', $id_client, PDO::PARAM_INT);
            $infoAdress->execute();
            header("Refresh:0;");
        } else {
            echo 'Erreur';
            return FALSE;
        }
    }


    // Récupérer et afficher une adresse en Bdd 
    public function ShowAndDeleteAdress()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM adresse WHERE adresse.id_client =  '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();
        foreach ($result as $resultat) {

            $id = $resultat['id'];
            $adresse = $resultat['adresse'];
            $code_postal = $resultat['code_postal'];
            $ville = $resultat['ville'];
            // echo $id;
            echo $adresse . ' ' . '<br />' . $code_postal . ' , ' . $ville . '<br />' . '<br />';
            ?>
            <td class="table_admin" name="id">
                <?php echo '<a class="href_admin" href="adresse.php?id=' . $id . '">' . 'Supprimer' . '</a>'; ?>
            </td>
            <br /><br /><?php
        }
        // Avec le GET_ID on supprime l'adresse de la Bdd
        if(isset($_GET['id']) AND !empty($_GET['id'])){ 

            $id = $_GET['id'];
            $supp00 = $con->prepare("DELETE FROM adresse WHERE id = :id ");
            $supp00->bindValue('id', $id, PDO::PARAM_INT);
            $supp00->execute();
            header('location:http://localhost:8888/boutique/Adresse/adresse.php');
        }

    }

    // Récupérer et afficher une adresse secondaire en Bdd

    public function ShowAndDeleteAdress2()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM adresse2 WHERE adresse2.id_client2 =  '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach ($result as $resultat){

            $id = $resultat['id2'];
            $adresse = $resultat['adresse2'];
            $code_postal = $resultat['code_postal2'];
            $ville = $resultat['ville2'];
            echo $adresse . ' ' . '<br />' . $code_postal . ' , ' . $ville . '<br />' . '<br />';
            ?>
            <td class="table_admin" name="id">
                <?php echo '<a class="href_admin" href="adresse.php?id=' . $id . '">' . 'Supprimer' . '</a>'; ?>
            </td>
            <br /><br /><?php
        }
        // Avec le GET_ID on supprime l'adresse de la Bdd
        if(isset($_GET['id']) AND !empty($_GET['id'])){

            $con = $this->connectDb();                      
            $id = $_GET['id'];
            $supp11 = $con->prepare("DELETE FROM adresse2 WHERE id2 = :id ");
            $supp11->bindValue('id', $id, PDO::PARAM_INT);
            $supp11->execute();
            header('location:http://localhost:8888/boutique/Adresse/adresse.php');
        }   
    }
}
?>