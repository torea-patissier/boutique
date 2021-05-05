<?php
session_start();
require_once('../html_partials/header.php');
require_once('../Classes/panier.class.php');
include '../autoloader.php';
$voirAdresse = new adresses;
$voirProfil = new profil;


if (!isset($_SESSION['user'])) {
    
    // A REFAIRE

    header('location:http://localhost:8888/boutique/Connexion/connexion.php');

    exit();
}else{

    $voirAdresse->checkAdress();

}

$nbProduits = count($_SESSION['panier']['libelleProduit']);


?>
<main class="container">    
    <table>
    <h1>Informations pour la livraison :</h1>
    <tr><td>
    <?php
    $voirProfil->voirInfosProfil();
    ?>
    </td><td>
    <?php
    $voirAdresse->voirAdressePrincipal();
    ?>
   </td> </tr>
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
                <td> <?php echo $_SESSION['panier']['libelleProduit'][$i]; ?> </td><br />
                <td> <?php echo $_SESSION['panier']['prixProduit'][$i]; ?>€</td><br />
                
                <?php if($_SESSION['panier']['qteProduit'][$i] > 10){
                    
                    $_SESSION['panier']['qteProduit'][$i] = 10;
                }
                ?>
                <td> <?php echo $_SESSION['panier']['qteProduit'][$i]; ?></td><br />
                <td><img class="hide-on-small-only" src="../Images/<?php echo $_SESSION['panier']['libelleProduit'][$i];?>.jpg"/><br /></td>

            </tr>
        <?php
        }
        ?>

        <tr>
            <td>
                <p> Total : <?php echo montantGlobal(); ?> € </p>
            </td><br />
        </tr>

    </table><br /><br />
    <?php require_once('../paypal.php'); ?>
</main>
    <!-- </body> -->

<?php
require_once('../html_partials/footer.php');
?>
