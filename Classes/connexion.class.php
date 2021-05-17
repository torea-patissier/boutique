<?php
require_once('bdd.class.php');
class connexion extends bdd {
    // Function pour s'inscrire
    public function connect()
    {
        $con = $this->connectDb(); // Connexion Db 
        $stmt = $con->prepare("SELECT * FROM info_client");// Requete
        $stmt->execute();
        $result = $stmt->fetchAll();       
        
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        
        for ($i = 0; isset($result[$i]); $i++) { // Boucle for pour parcourir le tableau
            $logcheck = $result[$i]['login']; // On recupère le login dans le tableau parcouru
            $passcheck = $result[$i]['password']; // Et ici le MDP 

            if ($login == $logcheck and password_verify($password, $passcheck) == TRUE) { // Si Login et MDP == aux valeurs dans le tab alors co + Verify pass 
                
                $_SESSION['user'] = $result[$i];
                var_dump($_SESSION['user']);
                
                header('location:http://localhost:8888/boutique/profil/profil.php');

            }
        }

        if($login !== $logcheck && password_verify($password, $passcheck) == FALSE){

            echo '<p class="container red-text"><b>Identifiant ou mot de passe incorrect.</b></p><br />';
            return FALSE; 

        }
  
    }
}

?>
