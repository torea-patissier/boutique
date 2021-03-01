<?php
require_once('bdd.class.php');
class inscription extends bdd {
        // Function pour s'inscrire
        public function register()
        {
            if (isset($_POST['inscription'])&& !empty($_POST['inscription'])) {
                //Connexion Db
                $con = $this->connectDb();
                //HTMLSPECHARS
                $login = htmlspecialchars($_POST['login']);
                $password = htmlspecialchars($_POST['password']);
                $confpassword = htmlspecialchars($_POST['confpassword']);
                $mail = htmlspecialchars($_POST['email']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $nom = htmlspecialchars($_POST['nom']);
                $date_de_naissance = htmlspecialchars($_POST['naissance']);
                $tel = htmlspecialchars($_POST['telephone']);
                $chiffre = 1;
                $testpwd = preg_match("#[A-Z]#", $password) + preg_match("#[a-z]#", $password) + preg_match("#[0-9]#", $password) + preg_match("#[^a-zA-Z0-9]#", $password);
                // Hashage mdp
                $options = ['cost' => 12,];
                $hash = password_hash($password, PASSWORD_BCRYPT, $options);
                //Vérifier si un login est déjà existant
                $stmt = $con->prepare("SELECT * FROM connexion_user WHERE login =?");
                $stmt->execute([$login]);
                $user = $stmt->fetch();
                if ($user) {
                    // Si il existe déjà echo message d'erreur
                    echo '<br/> <p class="erreur_inscription">Identifiant déjà existant.</p>';
                    return $user;
                    // Vérifier si les MDP sont les mêmes
                }
                if ([$password] != [$confpassword]) {
                    echo '<br />' . '<p class="erreur_inscription">Les mots de passe ne correspondent pas.</p>';
                    return $password;
                } 
                
                if($testpwd < 4){
                    echo '<br />' . '<p class="erreur_inscription">Rappel : Votre mot de passe doit contenir au minimum 7 caractères, incluant une Majuscule, un chifre et un caractère spécial.</p>';
                }else { // Si oui on créer le compte en Db
                   

                    $infoUser = $con->prepare("INSERT INTO info_client (nom, prenom, login, password, date_de_naissance, mail, tel, id_droits) VALUES (:nom, :prenom, :login, :hash, :date_de_naissance, :mail, :tel, :droits)");
                    $infoUser->bindValue('nom', $nom, PDO::PARAM_STR);
                    $infoUser->bindValue('prenom', $prenom, PDO::PARAM_STR);
                    $infoUser->bindValue('login', $login, PDO::PARAM_STR);
                    $infoUser->bindValue('hash', $hash, PDO::PARAM_STR);
                    $infoUser->bindValue('droits', $chiffre, PDO::PARAM_INT);
                    $infoUser->bindValue('date_de_naissance', $date_de_naissance, PDO::PARAM_STR);
                    $infoUser->bindValue('mail', $mail, PDO::PARAM_STR);
                    $infoUser->bindValue('tel', $tel, PDO::PARAM_INT);
                    $infoUser ->execute();
                    $infoUser->CloseCursor();

        
                    // $adressUser = $con->prepare("INSERT INTO adresse (adresse, code_postal, ville) VALUES (:adresse, :code_postal, :ville)");
                    // $adressUser->bindValue('adresse', $adresse, PDO::PARAM_STR);
                    // $adressUser->bindValue('code_postal', $code_postal, PDO::PARAM_INT);
                    // $adressUser->bindValue('ville', $ville, PDO::PARAM_STR);
                    
                    // $adressUser ->execute();
                    // $adressUser->CloseCursor();
                    // $infoUser -> execute();
                    // $adresseUser -> execute();
                    
                }
            }
        }
}
?>