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
            echo '<i>Pour modifier votre adresse actuelle vous devez supprimer l\'ancienne</i>';
            return false;
        } else {

            echo '
    <form action="adresse.php" method="POST">
    
    <label class="labelAdress">Adresse :</label><br />
    <input class="zonetxt_profil" type="text" name="adresse" required><br /><br />
    
    <labelclass="labelAdress">Code Postal :</label><br />
    <input class="zonetxt_profil" type="number" name="code_postal" required><br /><br />
    
    <labelclass="labelAdress">Ville :</label><br />
    <input class="zonetxt_profil" type="text" name="ville"required><br /><br />
    <input class="btn black" type="submit" name="envoyer" value="Ajouter mon adresse">
    </form>';
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
            echo $adresse . ' ' . '<br />' . $code_postal . ' , ' . $ville . '<br />' . '<br />';
            ?>
            <td class="table_admin" name="id">
                <?php echo '<b><a class="href_admin" href="adresse.php?id=' . $id . '">' . 'Supprimer' . '</a></b>'; ?>
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
    public function voirAdressePrincipal(){

        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM adresse where id_client = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $resultat = $req->fetchAll();

        foreach($resultat as $res){
            $adresse = $res['adresse'];
            $code_postal = $res['code_postal'];
            $ville = $res['ville'];
            echo '<i class="material-icons">home</i> <br />' . $code_postal . ' ' . $ville . '<br />' . '<br />';
            echo $adresse . '<br />';

        }

    }

    // Vérifier si l'utilisateur à une adresse lors de la commande
    public function checkAdress(){

        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM adresse where id_client = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $resultat = $req->fetchAll();
        if($resultat == false){
            
            header('location:http://localhost:8888/boutique/Adresse/adresse.php');
            exit();
        }
    }
}

?>