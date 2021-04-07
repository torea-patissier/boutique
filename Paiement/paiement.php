<?php
session_start();
require_once('../html_partials/header.php');
require_once('../Classes/panier.class.php');

if (!isset($_SESSION['user'])) {
    // A REFAIRE
    header('location:http://localhost:8888/boutique/Connexion/connexion.php');
    exit();
}
$nbProduits = count($_SESSION['panier']['libelleProduit']);

?>
<main>
<table>
    <tr>
        <th>Nom de l'article </th><br/>
        <th>Prix </th>
        <th>Quantité </th>
    </tr>

<?php
for ($i=0 ;$i < $nbProduits ; $i++){

    ?>

    <tr>
       <td> <?php echo $_SESSION['panier']['libelleProduit'][$i];?> </td><br/>
       <td> <?php echo $_SESSION['panier']['prixProduit'][$i];?>€</td><br/>
       <td> <?php echo $_SESSION['panier']['qteProduit'][$i];?></td><br/>
    </tr>
    
    
    <?php
      }
    ?> 

    <tr>
       <td> <p> Total : <?php echo montantGlobal();?> € </p> </td><br />
    </tr>
    </table>
    <?php require_once('../paypal.php');?>
    </main>

<?php
require_once('../html_partials/footer.php');
?>