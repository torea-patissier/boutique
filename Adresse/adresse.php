<?php
session_start();
include '../autoloader.php';
$pageAdresse = new adresses();
$pageAdresse->ShowMainAdresse();
?>
<!-- <h3>Adresse principale</h3>
<form action="adresse.php" method="POST">

<label>Adresse :</label><br />
<input class="zonetxt_profil" type="text" name="adresse" required><br /><br />

<label>Code Postal :</label><br />
<input class="zonetxt_profil" type="number" name="code_postal" required><br /><br />

<label>Ville :</label><br />
<input class="zonetxt_profil" type="text" name="ville"required><br /><br />
<input class="button-profil2" type="submit" name="envoyer" value="Ajouter mon adresse">
</form> -->


<h3>Adresse secondaire</h3>
<form action="adresse.php" method="POST">

<label>Adresse :</label><br />
<input class="zonetxt_profil" type="text" name="adresse2" required><br /><br />

<label>Code Postal :</label><br />
<input class="zonetxt_profil" type="number" name="code_postal2" required><br /><br />

<label>Ville :</label><br />
<input class="zonetxt_profil" type="text" name="ville2"required><br /><br />

<input class="button-profil2" type="submit" name="envoyer2" value="Ajouter mon adresse">

</form>
<a href="http://localhost:8888/boutique/profil/profil.php">Retour au profil</a><br /><br />

<h4>Adresse principale :</h4>
<?= $pageAdresse->ShowAndDeleteAdress();?>
<h4>Adresse secondaire :</h4>
<?= $pageAdresse->ShowAndDeleteAdress2();?>

<?php


        if (isset($_POST['envoyer'])) {
            $pageAdresse->AddAdress();
        }
        if (isset($_POST['envoyer2'])) {
            $pageAdresse->AddAdress2();
        }
?>