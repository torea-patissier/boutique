<?php 
    session_start();

include '../autoloader.php';

$pageInscription = new inscription;
?>
<div class="imgBack">
<main class="main_inscription">
<section class="formulaire_inscription">
<h2 class="h2_inscription">Inscription</h2>
<p>Veuillez compléter les champs ci dessous</p>
<form action="inscription.php" method="POST">

    <!-- Informations Connexion -->
    <input class="zonetxt_inscription" type="text" name="login" placeholder="Login" required><br /><br />
    <input class="zonetxt_inscription" type="password" name="password" placeholder="Mot de passe" required><br /><br />
    <input class="zonetxt_inscription" type="password" name="confpassword" placeholder="Conf. Mot de passe" required><br /><br />
    <input class="zonetxt_inscription" type="email" name="email" placeholder="E-mail" required><br /><br />
    <!-- Informations Personnelles -->
    <input class="zonetxt_inscription" type="text" name="prenom" placeholder="Prénom" required><br /><br />
    <input class="zonetxt_inscription" type="text" name="nom" placeholder="Nom" required><br /><br />
    <input type="date" name="naissance" value="01-01-2000" min="01-01-1900" max="01-01-2006"><br /><br />
    <input class="zonetxt_inscription" type="text" name="telephone" placeholder="Numéro de téléphone" required><br /><br />

    <input class="button-inscription" type="submit" name="inscription" value="Valider">
    <br /><br />
    <p class="dejauncompte_inscription">Vous avez déjà un compte chez nous ? <a class="href_inscription" href="../Connexion/connexion.php">Connectez vous</a>.</p>
</form>
</section>
<?php
    if(isset($_POST["inscription"])){
        $pageInscription->register();
    }
?>
</div>
</main>