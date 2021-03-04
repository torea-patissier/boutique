<?php
require_once('bdd.class.php');

class adresses extends bdd{


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

if($result != null){
    echo'Vous ne pouvez avoir qu\'une seule adresse principale';
    return false;
}else{

    echo'
    <h3>Adresse principale</h3>
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


//Ajouter une adresse en Bdd

public function AddAdress()
{
    if(isset($_POST['envoyer']) && !empty('envoyer')){
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
                            $infoAdress ->execute();
                            header("Refresh: 0;");
                            // header("Refresh: 0;url=http://localhost:8888/boutique/Profil/profil.php");

    }else{
        echo 'Erreur';
        return FALSE;

    }

}


//Ajouter une adresse2 en Bdd

public function AddAdress2()
{
    if(isset($_POST['envoyer2']) && !empty('envoyer2')){
        $con = $this->connectDb();
        $adresse2 = htmlspecialchars($_POST['adresse2']);
        $code_postal2 = htmlspecialchars($_POST['code_postal2']);
        $ville2 = htmlspecialchars($_POST['ville2']);
        $id_client2 = $_SESSION['user']['id'];
// Vérifier si elle existe en Bdd, si c'est le cas, return false
        $verifAdress = $con->prepare("SELECT * FROM adresse2 WHERE id2 = '$id_client2' ");
        $verifAdress->execute([$id_client2]);
        $result = $verifAdress->fetch();
        if($result){

            echo'Non';
            return $id_client2;
        }else{

            $infoAdress = $con->prepare("INSERT INTO adresse2 (adresse2, code_postal2, ville2, id_client2) VALUES (:adresse, :code_postal, :ville, :id_client)");
            $infoAdress->bindValue('adresse', $adresse2, PDO::PARAM_STR);
            $infoAdress->bindValue('code_postal', $code_postal2, PDO::PARAM_INT);
            $infoAdress->bindValue('ville', $ville2, PDO::PARAM_STR);
            $infoAdress->bindValue('id_client', $id_client2, PDO::PARAM_INT);
            $infoAdress ->execute();
            header("Refresh: 0;");
        }

    }else{
        echo 'Erreur';
        return FALSE;

    }

}


// Récupérer et afficher une adresse en Bdd 

public function ShowAndDeleteAdress()
{
    $con = $this->connectDb();
    $req = $con->prepare("SELECT * FROM adresse INNER JOIN info_client WHERE id_client = info_client.id ");
    $req->execute();
    $result = $req->fetchAll();
    foreach($result as $resultat){
        $id = $resultat['id'];
        $adresse = $resultat['adresse'];
        $code_postal = $resultat['code_postal'];
        $ville = $resultat['ville'];
        // echo $id;
        echo $adresse . ' ' . '<br />' . $code_postal .' , '. $ville . '<br />' . '<br />';
        ?>
        <td class="table_admin" name="id"><?php echo '<a class="href_admin" href="../Supprimer/supprimer.php?id=' . $id . '">' . 'Supprimer' . '</a>'; ?></td>
        <br /><br /><?php
    }
}

public function ShowAndDeleteAdress2()
{
    $con = $this->connectDb();
    $req = $con->prepare("SELECT * FROM adresse2 INNER JOIN info_client WHERE id_client2 = info_client.id ");
    $req->execute();
    $result = $req->fetchAll();

    foreach($result as $resultat){
        $id = $resultat['id2'];
        $adresse = $resultat['adresse2'];
        $code_postal = $resultat['code_postal2'];
        $ville = $resultat['ville2'];
        // echo $id;
        echo $adresse . ' ' . '<br />' . $code_postal .' , '. $ville . '<br />' . '<br />';
        ?>
        <td class="table_admin" name="id"><?php echo '<a class="href_admin" href="../Supprimer/supprimer.php?id=' . $id . '">' . 'Supprimer' . '</a>'; ?></td>
        <br /><br /><?php
    }
}


}
?>