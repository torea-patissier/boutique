<?php 

include "../Classes/inscription.class.php"; 
require_once("../html_partials/header.index.php");
require_once("../html_partials/header.php");
require_once("../html_partials/footer.php");

$pageInscription = new inscription;
?>
<div class="imgBack">
<main class="main_inscription">
<section class="formulaire_inscription">
<h2 class="h2_inscription">Inscription</h2>
<p>Veuillez compléter les champs ci dessous</p>


    <!-- Informations Connexion -->
    <div class="container row">
        <form class="col s6" action="inscription.php" method="POST">
            <div class="row">
                <div class="input-field col s4 offset-s5">
                    <input class="zonetxt_inscription" type="text" name="login" placeholder="Login" required><br /><br />
                </div>
                <div class="input-field col s4 offset-s5">
                    <input class="zonetxt_inscription" type="password" name="password" placeholder="Mot de passe" required><br /><br />
                </div>
                <div class="input-field col s4 offset-s5">
                    <input class="zonetxt_inscription" type="password" name="confpassword" placeholder="Conf. Mot de passe" required><br /><br />
                </div>
                <div class="input-field col s4 offset-s5">
                    <input class="zonetxt_inscription" type="email" name="email" placeholder="E-mail" required><br /><br />
                </div>
            </div>
    </form>
    <!-- Informations Personnelles -->
    <form class="col s6" action="inscription.php" method="POST">
        <div class="row">
            <div class="input-field col s4 offset-s3">
                <input class="zonetxt_inscription" type="text" name="prenom" placeholder="Prénom" required><br /><br />
            </div>
            <div class="input-field col s4 offset-s3">
                <input class="zonetxt_inscription" type="text" name="nom" placeholder="Nom" required><br /><br />
            </div>
            <div class="input-field col s4 offset-s3">
                <input type="date" name="naissance" value="01-01-2000" min="01-01-1900" max="01-01-2006"><br /><br />
            </div>
            <div class="input-field col s4 offset-s3">
                <input class="zonetxt_inscription" type="text" name="telephone" placeholder="Numéro de téléphone" required><br /><br />
            </div>
        </div>
    </form>
    <input class="waves-effect waves-light btn-small darken-4" type="submit" name="inscription" value="Valider">
    <br /><br />
    <p class="dejauncompte_inscription">Vous avez déjà un compte chez nous ? <a class="href_inscription" href="../Connexion/connexion.php"><br />Connectez vous</a>.</p>

 

</div>
</section>
<?php
    if(isset($_POST["inscription"])){
        $pageInscription->register();
    }
?>
</div>
</main>

    