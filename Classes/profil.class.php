<?php 
require_once('../Classes/bdd.class.php');
class modprofil extends bdd{
    
    public function profil()
    {

        if (isset($_POST['modifier'])) {
            $id = $_SESSION['user']['id'];
            $log = $_SESSION['user']['login'];
            $con = $this->connectDb();
            $stmt = $con->prepare("SELECT * FROM utilisateurs WHERE login = :log ");
            $stmt->bindValue('log', $log, PDO::PARAM_STR);
            $stmt->execute();
            $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
            $userName = htmlspecialchars($_POST['username']);
            $login = htmlspecialchars($_POST['login']);
            $mdp = htmlspecialchars($_POST['password']);
            $conf =  htmlspecialchars($_POST['confpass']);
            $email = htmlspecialchars($_POST['email']);
            $options = ['cost' => 12,];
            $hash = password_hash($mdp, PASSWORD_BCRYPT, $options);

            if (isset($_POST['username']) && !empty($_POST['username'])){
                $sql = $con->prepare("UPDATE utilisateurs SET username= :userName WHERE id = :id ");
                $sql->bindValue('userName', $userName, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['username'] = $userName;
                echo '<br /><p class="modif_profil"> Nom d\'utilisateur modifié </p>';
            }

            if (isset($_POST['login']) && !empty($_POST['login'])) {
                $sql = $con->prepare("UPDATE utilisateurs SET login= :login WHERE id = :id ");
                $sql->bindValue('login', $login, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['login'] = $_POST['login'];
                echo '<br/><p class="modif_profil"> Login modifié </p>';
            }
            if ($mdp != $conf) {
                echo ('<br/><p class="erreur_profil"> Mot de passe incorrect </p>');
                return false;
            } elseif (isset($_POST['password']) || isset($_POST['confpass']) && !empty($_POST['password']) && !empty($_POST['confpass'])) {

                $sql = $con->prepare("UPDATE utilisateurs SET password= :hash WHERE id = :id ");
                $sql->bindValue('hash', $hash, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['password'] = $_POST['password'];

                echo '<br/><p class="modif_profil"> Mot de passe modifié </p>';
            }
            if(isset($_POST['email']) && !empty($_POST['email'])){

                $sql = $con->prepare("UPDATE utilisateurs SET email= :email WHERE id = :id ");
                $sql->bindValue('email', $email, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['email'] = $_POST['email'];
                echo '<br/><p class="modif_profil"> Email modifié </p>';



            }
        }
    }

    // Fonction déco + redirection 
    public function Deconnexion()
    {
        session_destroy();
        header("location:http://localhost/blog/Connexion/connexion.php");
    }

}

?>