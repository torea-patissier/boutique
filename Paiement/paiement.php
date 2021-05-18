<?php
session_start();
require_once('../html_partials/header.php');
require_once('../Classes/panier.class.php');
include '../autoloader.php';
$voirAdresse = new adresses;
$voirProfil = new profil;


if (!isset($_SESSION['user'])) {


    header('location:http://localhost/boutique/Connexion/connexion.php');

    exit();
} else {

    $voirAdresse->checkAdress();
}

$nbProduits = count($_SESSION['panier']['libelleProduit']);


?>
<main class="container">
<h1 class="hide-on-small-only">Récapitulatif de commande : </h1>
<h2 class="hide-on-med-and-up">Récapitulatif de commande : </h2>
    <table class="responsive-table">
        <tr>
            <th>Nom de l'article </th><br />
            <th>Prix </th>
            <th>Quantité </th>
            <th class="hide-on-small-only">Image </th>
        </tr>

        <?php
        for ($i = 0; $i < $nbProduits; $i++) {
        ?>
            <tr>
                <td><b> <?php echo $_SESSION['panier']['libelleProduit'][$i]; ?> </b></td><br />
                <td><b> <?php echo $_SESSION['panier']['prixProduit'][$i]; ?>€</b></td><br />

                <?php if ($_SESSION['panier']['qteProduit'][$i] > 10) {

                    $_SESSION['panier']['qteProduit'][$i] = 10;
                }
                ?>
                <td><b> <?php echo $_SESSION['panier']['qteProduit'][$i]; ?></b></td><br />
                <td><img class="hide-on-small-only" src="../Images/<?php echo $_SESSION['panier']['libelleProduit'][$i]; ?>.jpg" width="500px" height="500px" /><br /></td>
                <td><img class="hide-on-med-and-up" src="../Images/<?php echo $_SESSION['panier']['libelleProduit'][$i]; ?>.jpg" width="200px" height="200px" /><br /></td>
            </tr>
        <?php
        }
        ?>

        <tr>
            <td>
                <p><b> Total : <?php echo montantGlobal(); ?> € </b></p>
            </td><br />
        </tr>

    </table><br /><br />
    <?php require_once('../paypal.php'); ?>
</main>
<!-- </body> -->

<?php
require_once('../html_partials/footer.php');
?>