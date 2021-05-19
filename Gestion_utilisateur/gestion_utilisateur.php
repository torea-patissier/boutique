<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';

if ($id_droits != 2) {
    header('location:http://localhost/boutique/Error/404.php');
    exit();
}

if (isset($_POST['retourAdmin'])) {
    header('location:http://localhost/boutique/Admin/admin.php');
}


echo '<main class="paginationArticles1">';
?>
<h1 class="container">Gestion des utilisateurs : </h1><br /><br />
<?php
$pageModifUser = new gestion_utilisateur();
$pageModifUser->ShowIdDroits();
echo '</main>';
?>
<br /><br />
<div class="col s12 center-align">
    <form action="#" method="post">
        <input class="btn black" type="submit" name="retourAdmin" value="Retour Admin">
    </form>
</div>
<?php
require_once('../html_partials/footer.php');
?>