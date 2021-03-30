<?php
require_once('bdd.class.php');

class modifier_utilisateur extends bdd
{
    public function ShowUtilisateur()
    {
        $getId = $_GET['id'];
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM info_client WHERE id = :getId ");
        $req->bindValue('getId', $getId, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll();
        foreach ($result as $value) {
            $id = $value['id'];
            $login = $value['login'];
            $email = $value['email'];
            $id_droits = $value['id_droits'];
?>
            <form action="" method="POST">
                <label>Login</label><br />
                <input type="text" name="login" value="<?php echo $login; ?>"><br />
                <label>Mail</label><br />
                <input type="text" name="email" value="<?php echo $email; ?>"><br />
                <label>ID droit</label><br />
                <input type="text" name="id_droits" value="<?php echo $id_droits; ?>"><br />
                <input type="submit" name="modifier" value="Modifier">
            </form>
<?php
            if (isset($_POST['modifier'])) {
                $newLogin = htmlspecialchars($_POST['login']);
                $newEmail = htmlspecialchars($_POST['email']);
                $newId_droits = htmlspecialchars($_POST['id_droits']);

                if (!empty($_POST['login'])) {
                    $reqID = $con->prepare("UPDATE info_client SET  login = :newLogin WHERE id = :id ");
                    $reqID->bindValue('newLogin', $newLogin, PDO::PARAM_STR);
                    $reqID->bindValue('id', $id, PDO::PARAM_INT);
                    $reqID->execute();
                }
                if (!empty($_POST['email'])) {
                    $reqEmail = $con->prepare("UPDATE info_client SET  email = :newEmail WHERE id = :id ");
                    $reqEmail->bindValue('newEmail', $newEmail, PDO::PARAM_STR);
                    $reqEmail->bindValue('id', $id, PDO::PARAM_INT);
                    $reqEmail->execute();
                    
                }
                if (!empty($_POST['id_droits'])) {
                    $reqIdDroits = $con->prepare("UPDATE info_client SET  id_droits = :newIdDroits WHERE id = :id ");
                    $reqIdDroits->bindValue('newIdDroits', $newId_droits, PDO::PARAM_INT);
                    $reqIdDroits->bindValue('id', $id, PDO::PARAM_INT);
                    $reqIdDroits->execute();
                }
                header("Refresh: 0;url=http://localhost:8888/boutique/Admin/admin.php");
            }
        }
    }
}


?>