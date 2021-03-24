<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageProfil = new profil();
echo'<pre>';
var_dump($_SESSION['user']);
echo'</pre>';

?>
<div class="imgBack">
    <main class="main_profil">
        <section class="formulaire_profil">
            <h2 class="h2_profil">Profil</h2>
            <?= 'Bonjour' . ' ' . $_SESSION['user']['prenom'] . ' ' . '!' ?>
            <p>Pour modifier vos informations, veuillez remplir les champs ci-dessous</p>
            <form action="profil.php" method="POST">

                <label>Nom :</label><br />
                <input class="zonetxt_profil" type="text" name="nom" placeholder=<?= $_SESSION['user']['nom'] ?>><br /><br />

                <label>Prénom :</label><br />
                <input class="zonetxt_profil" type="text" name="prenom" placeholder=<?= $_SESSION['user']['prenom'] ?>><br /><br />

                <label>Date de naissance :</label><br />
                <input class="zonetxt_profil" type="text" name="date_naissance" placeholder=<?= $_SESSION['user']['date_de_naissance'] ?>><br /><br />

                <label>Tel : </label><br />
                <input class="zonetxt_profil" type="number" name="tel" placeholder=<?= $_SESSION['user']['tel'] ?>><br /><br />

                <label>Identifiant :</label><br />
                <input class="zonetxt_profil" type="text" name="login" placeholder=<?= $_SESSION['user']['login'] ?>><br /><br />

                <label>Mot de passe :</label><br />
                <input class="zonetxt_profil" type="password" name="password" placeholder="Mot de passe"><br /><br />

                <label>Confirmation de mot de passe :</label><br />
                <input class="zonetxt_profil" type="password" name="confpass" placeholder="Confimation mdp"><br /><br />

                <label>E-mail :</label><br />
                <input class="zonetxt_profil" type="email" name="email" placeholder=<?= $_SESSION['user']['mail'] ?>><br /><br />

                <input class="button-profil" type="submit" name="modifier"><br /><br />
                <input class="button-profil2" type="submit" name="deco" value="Déconnexion">

            </form>
        </section>

        <a href="http://localhost:8888/boutique/Adresse/adresse.php">Voir | ajouter une adresse</a>

        <?php $pageProfil->Seeprofil(); ?>
        <?php
        if (isset($_POST['deco'])) {
            $pageProfil->Deconnexion();
        }
        ?>
</div>
</main>
<?php require_once('../html_partials/header.php');?>