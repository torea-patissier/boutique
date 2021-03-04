<?php 
require_once('bdd.class.php');
class profil extends bdd{
    
    public function Seeprofil()
    {

        if (isset($_POST['modifier'])) {
            $id = $_SESSION['user']['id'];
            $log = $_SESSION['user']['login'];
            $con = $this->connectDb();
            $stmt = $con->prepare("SELECT * FROM info_client WHERE login = :log ");
            $stmt->bindValue('log', $log, PDO::PARAM_STR);
            $stmt->execute();
            $fetch = $stmt->fetch(PDO::FETCH_ASSOC);

            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $date_de_naissance = htmlspecialchars($_POST['date_naissance']);
            $tel = htmlspecialchars($_POST['tel']);
            $login = htmlspecialchars($_POST['login']);
            $mdp = htmlspecialchars($_POST['password']);
            $conf =  htmlspecialchars($_POST['confpass']);
            $email = htmlspecialchars($_POST['email']);
            $options = ['cost' => 12,];
            $hash = password_hash($mdp, PASSWORD_BCRYPT, $options);
            $testpwd = preg_match("#[A-Z]#", $mdp) + preg_match("#[a-z]#", $mdp) + preg_match("#[0-9]#", $mdp) + preg_match("#[^a-zA-Z0-9]#", $mdp);

//Modification du Nom en Bdd

            if (isset($nom) && !empty($nom)) {
                $sql = $con->prepare("UPDATE info_client SET nom= :nom WHERE id = :id ");
                $sql->bindValue('nom', $nom, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['nom'] = $nom;
                echo '<br/><p class="modif_profil"> Nom modifié </p>';
                var_dump($nom);
            }

//Modification du Prénom en Bdd

            if (isset($prenom) && !empty($prenom)) {
                $sql = $con->prepare("UPDATE info_client SET prenom= :prenom WHERE id = :id ");
                $sql->bindValue('prenom', $prenom, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['prenom'] = $prenom;
                echo '<br/><p class="modif_profil"> Prénom modifié </p>';
                var_dump($prenom);
            }

//Modification de la date de naissance en Bdd

            if (isset($date_de_naissance) && !empty($date_de_naissance)) {
                $sql = $con->prepare("UPDATE info_client SET date_de_naissance= :date_de_naissance WHERE id = :id ");
                $sql->bindValue('date_de_naissance', $date_de_naissance, PDO::PARAM_STR_CHAR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['date_de_naissance'] = $date_de_naissance;
                echo '<br/><p class="modif_profil"> Date de naissance modifié </p>';
                var_dump($date_de_naissance);
            }
 
//Modifiation du n de Tel en Bdd           

            if (isset($tel) && !empty($tel)) {
                $sql = $con->prepare("UPDATE info_client SET tel= :tel WHERE id = :id ");
                $sql->bindValue('tel', $tel, PDO::PARAM_STR_CHAR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['tel'] = $tel;
                echo '<br/><p class="modif_profil"> Téléphone modifié </p>';
                var_dump($tel);
            }

//Modification du Login en Bdd

            if (isset($login) && !empty($login)) {
                $sql = $con->prepare("UPDATE info_client SET login= :login WHERE id = :id ");
                $sql->bindValue('login', $login, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['login'] = $login;
                echo '<br/><p class="modif_profil"> Login modifié </p>';
                var_dump($login);
            }

//Modification du Mot de passe en Bdd

            if($testpwd < 4){

                echo '<br />' . '<p class="erreur_inscription">Rappel : Votre mot de passe doit contenir au minimum 7 caractères, incluant une Majuscule, un chifre et un caractère spécial.</p>';
            }else { // Si oui on créer le compte en Db
            if ($mdp != $conf) {
                echo ('<br/><p class="erreur_profil"> Mot de passe incorrect </p>');
                return false;
            } elseif (isset($hash) || isset($conf) && !empty($hash) && !empty($conf)) {
                $sql = $con->prepare("UPDATE info_client SET password= :hash WHERE id = :id ");
                $sql->bindValue('hash', $hash, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['password'] = $hash;
                echo '<br/><p class="modif_profil"> Mot de passe modifié </p>';
                var_dump($hash);
            }
        }
        
//Modification de l'E-mail en Bdd

            if(isset($email) && !empty($email)){

                $sql = $con->prepare("UPDATE info_client SET mail= :mail WHERE id = :id ");
                $sql->bindValue('mail', $email, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['mail'] = $email;
                echo '<br/><p class="modif_profil"> E-mail modifié </p>';



            }
        }
    }

    // Fonction déco + redirection 
    public function Deconnexion()
    {
        session_destroy();
        header("location:http://localhost:8888/boutique/Connexion/connexion.php");
    }



}
?>
