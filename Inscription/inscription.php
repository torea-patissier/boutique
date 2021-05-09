<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';

$pageInscription = new inscription;
?>
<main class="main_inscription">
    <div class="container">
        <div class="row">
            <h2 class="center-align">Inscription</h2>
            <p>Veuillez compléter les champs ci dessous</p>
            <form action="inscription.php" method="POST">

                <div class="col s12 m6 l6">
                    <!-- Informations Connexion -->
                    <input class="zonetxt_inscription" type="text" name="login" placeholder="Identifiant" required><br /><br />
                    <input class="zonetxt_inscription" type="password" name="password" placeholder="Mot de passe" required><br /><br />
                    <input class="zonetxt_inscription" type="password" name="confpassword" placeholder="Conf. Mot de passe" required><br /><br />
                    <input class="zonetxt_inscription" type="email" name="email" placeholder="E-mail" required><br /><br />
                </div>
                <div class="col s12 m6 l6">
                    <!-- Informations Personnelles -->
                    <input class="zonetxt_inscription" type="text" name="prenom" placeholder="Prénom" required><br /><br />
                    <input class="zonetxt_inscription" type="text" name="nom" placeholder="Nom" required><br /><br />
                    <input type="date" name="naissance" value="01-01-2000" min="01-01-1900" max="01-01-2006"><br /><br />
                    <input class="zonetxt_inscription" type="text" name="telephone" placeholder="Numéro de téléphone" required><br /><br />
                </div>

                <div class="center-align">
                    <input class="btn black" type="submit" name="inscription" value="Valider">
                </div>
                <br /><br />
                <p class="dejauncompte_inscription">Vous avez déjà un compte chez nous ? <a class="href_inscription" href="../Connexion/connexion.php"><b>Connectez vous</b></a>.</p>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST["inscription"])) {
        $pageInscription->register();
    }
    ?>
</main>
<?php require_once('../html_partials/footer.php'); ?>