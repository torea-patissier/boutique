<?php 
require_once('bdd.class.php');
class profil extends bdd{

    // Fonction déco + redirection 
    public function Deconnexion()
    {
        header("location:http://localhost/boutique/index.php");
        session_destroy();
    }
    
    public function modifierProfil()
    {

        if (isset($_POST['modifier'])) {
            $id = $_SESSION['user']['id'];
            $log = $_SESSION['user']['login'];
            $con = $this->connectDb();
            $stmt = $con->prepare("SELECT * FROM info_client WHERE login = :log ");
            $stmt->bindValue('log', $log, PDO::PARAM_STR);
            $stmt->execute();
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
            header("Refresh: 0");

//Modification du Nom en Bdd

            if (isset($nom) && !empty($nom)) {
                $sql = $con->prepare("UPDATE info_client SET nom= :nom WHERE id = :id ");
                $sql->bindValue('nom', $nom, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['nom'] = $nom;
            }

//Modification du Prénom en Bdd

            if (isset($prenom) && !empty($prenom)) {
                $sql = $con->prepare("UPDATE info_client SET prenom= :prenom WHERE id = :id ");
                $sql->bindValue('prenom', $prenom, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['prenom'] = $prenom;
            }

//Modification de la date de naissance en Bdd

            if (isset($date_de_naissance) && !empty($date_de_naissance)) {
                $sql = $con->prepare("UPDATE info_client SET date_de_naissance= :date_de_naissance WHERE id = :id ");
                $sql->bindValue('date_de_naissance', $date_de_naissance, PDO::PARAM_STR_CHAR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['date_de_naissance'] = $date_de_naissance;
            }
 
//Modifiation du n de Tel en Bdd           

            if (isset($tel) && !empty($tel)) {
                $sql = $con->prepare("UPDATE info_client SET tel= :tel WHERE id = :id ");
                $sql->bindValue('tel', $tel, PDO::PARAM_STR_CHAR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['tel'] = $tel;
            }

//Modification du Login en Bdd

            if (isset($login) && !empty($login)) {
                $sql = $con->prepare("UPDATE info_client SET login= :login WHERE id = :id ");
                $sql->bindValue('login', $login, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['login'] = $login;
            }

//Modification du Mot de passe en Bdd

            if(isset($mdp) && !empty($conf)){

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
                        }
            }
        }
        
//Modification de l'E-mail en Bdd

            if(isset($email) && !empty($email)){

                $sql = $con->prepare("UPDATE info_client SET email= :email WHERE id = :id ");
                $sql->bindValue('email', $email, PDO::PARAM_STR);
                $sql->bindValue('id', $id, PDO::PARAM_INT);
                $sql->execute();
                $_SESSION['email'] = $email;

            }
        }
    }


    public function voirInfosProfil()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM info_client where id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach($result as $resultat){
            $nom = $resultat['nom'];
            $prenom = $resultat['prenom'];
            $tel = $resultat['tel'];
            $mail = $resultat['email'];
            echo '<i class="material-icons">person</i> <br />' . 'Mr,Mme : ' . $nom . ' ' . $prenom . '<br />';
            echo '<i class="material-icons">phone</i> <br />' . 'Tel : ' . $tel . '<br />';
            echo '<i class="material-icons">email</i> <br />' . 'Email : ' . $mail . '<br />';
        } 
    }
    // LES CLASSES CI DESSOUS POUR LES PLACEHOLDER DE PROFIL
    public function voirPrenom()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM info_client where id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach($result as $resultat){
            $prenom = $resultat['prenom'];
        }
        echo $prenom;
    }

    public function voirNom()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM info_client where id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach($result as $resultat){
            $nom = $resultat['nom'];
        }
        echo $nom;
    }

    public function voirLogin()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM info_client where id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach($result as $resultat){
            $login = $resultat['login'];
        }
        echo $login;
    }

    public function voirDate()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM info_client where id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach($result as $resultat){
            $date = $resultat['date_de_naissance'];
        }
        echo $date;
    }

    public function voirEmail()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM info_client where id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach($result as $resultat){
            $email = $resultat['email'];
        }
        echo $email;
    }

    public function voirTel()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM info_client where id = '" . $_SESSION['user']['id'] . "' ");
        $req->execute();
        $result = $req->fetchAll();

        foreach($result as $resultat){
            $tel = $resultat['tel'];
        }
        echo $tel;
    }
}
?>