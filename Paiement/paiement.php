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
}
$nbProduits = count($_SESSION['panier']['libelleProduit']);


?>
<main>    
    <table>
    <h2>Résumé de votre commande :</h2>
    <h3>Informations pour la livraison :</h3>
    <?php
    $voirProfil->voirInfosProfil();
    $voirAdresse->voirAdressePrincipal();
    ?>
        <p>Délais de livraison estimé à 3 jours </p>

        <tr>
            <th>Nom de l'article </th><br />
            <th>Prix </th>
            <th>Quantité </th>
            <th>Image </th>
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
                <td><img src="../Images/<?php echo $_SESSION['panier']['libelleProduit'][$i];?>.jpg"/><br /></td>

            </tr>
        <?php
        }
        ?>

        <tr>
            <td>
                <p> Total : <?php echo montantGlobal(); ?> € </p>
            </td><br />
        </tr>

    </table>
    <?php require_once('../paypal.php'); ?>
</main>

<?php
require_once('../html_partials/footer.php');
?>