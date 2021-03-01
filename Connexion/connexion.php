<?php 
session_start();
include "../Classes/connexion.class.php"; 
$pageConnexion = new connexion;
?>
<div class="imgBack">
<main class="main_connexion">
<section class="formulaire_connexion">
<h2 class="h2_connexion">Connexion</h2>
<p>Veuillez indiquer vos identifiants pour vous connecter</p>
<form action="connexion.php" method="POST">
    <input class="zonetxt_connexion" type="text" name="login" required><br /><br />
    <input class="zonetxt_connexion" type="password" name="password" required><br /><br />
    <input class="button-connexion" type="submit" name="connecter">
    <p class="dejauncompte_connexion">Vous n'avez pas de compte chez nous ? <a class="href_connexion" href="../Inscription/inscription.php">Inscrivez vous</a>.</p>
</form>
</section>
</main>
</div>
<?php
    if(isset($_POST["connecter"])){
        $pageConnexion->connect();
    }
?>