<?php 
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageConnexion = new connexion();
?>
<main class="container ">
<div id="connexion">
<h2 class="h2_connexion">Connexion</h2>
<p>Veuillez indiquer vos identifiants pour vous connecter</p>
<form  class="col s12 l6" action="connexion.php" method="POST">
    <input class="zonetxt_connexion" type="text" name="login" placeholder="Identifiants" required><br /><br />
    <input class="zonetxt_connexion" type="password" name="password" placeholder="Mot de passe" required><br /><br />
    <a class=""><input class="btn black" type="submit" name="connecter" value=" Se connecter" ></a>
    <p class="dejauncompte_connexion">Vous n'avez pas de compte chez nous ? <a class="href_connexion" href="../Inscription/inscription.php"><b>Inscrivez vous</b></a>.</p>
</form><br/>
</div><br/>
</main><br/>
<?php
    if(isset($_POST["connecter"])){
        
        $pageConnexion->connect();
    }
    
    require_once('../html_partials/footer.php');
?>