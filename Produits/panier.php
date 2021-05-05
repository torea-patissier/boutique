<?php
session_start();

require_once('../html_partials/header.php');
require_once('../Classes/panier.class.php');
include '../autoloader.php';
$product = new produits;
$erreur = false;

if (isset($_POST['envoyerCommande']) && $_SESSION['user']['id']) {

   $product->envoyerCommande($rand);
   $product->envoyerTotal($total, $rand);
   header("location:http://localhost:8888/boutique/Paiement/paiement.php");
}else{
   if (isset($_POST['envoyerCommande']) && !$_SESSION['user']['id']) {
   header("location:http://localhost:8888/boutique/Connexion/connexion.php");
   }
}

$rand = rand(0, 1000000);
//(?) = alors // (:) = sinon
// Si $POST action existe alors il devient POST sinon et vice versa pour GET
$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null));

if ($action !== null) {
   if (!in_array($action, array('ajout', 'suppression', 'refresh')))
      // Check si les valeurs existent dans un tableau

      $erreur = true;

   //récupération des variables en POST ou GET
   $l = (isset($_POST['l']) ? $_POST['l'] : (isset($_GET['l']) ? $_GET['l'] : null));
   $q = (isset($_POST['q']) ? $_POST['q'] : (isset($_GET['q']) ? $_GET['q'] : null));
   $p = (isset($_POST['p']) ? $_POST['p'] : (isset($_GET['p']) ? $_GET['p'] : null));
   $idA = (isset($_POST['i']) ? $_POST['i'] : (isset($_GET['i']) ? $_GET['i'] : null));

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '', $l);
   $idA = preg_replace('#\v#', '', $idA);

   //On vérifie que $p est un float (chiffre entier ou décimal)
   $p = floatval($p);

   //On traite $q qui peut être un entier simple ou un tableau d'entiers
   if (is_array($q)) {

      $qteProduit = array();
      $i = 0;

      foreach ($q as $contenu) {

         $qteProduit[$i++] = intval($contenu);
      }
   } else {

      $q = intval($q);
   }
}

if (!$erreur) {

   switch ($action) { // Succession de if par rapport à $action

      case "ajout":

         ajouterProduit($l, $q, $p, $idA); // Nom, quantité, prix du produit
         break;

      case "suppression":

         supprimerProduit($l);
         break;

      case "refresh":

         for ($i = 0; $i < count($qteProduit); $i++) {
            modifierQteProduit($_SESSION['panier']['libelleProduit'][$i], round($qteProduit[$i]));
            //$_SESSION['panier']['libelleProduit'][$i] et round pour arrondir la valeur de la quantité
         }
         break;

      default:

         break;
   }
}

?>

<main class="container">
   <div class="row">
      <form  class="col s12 m12" method="post" action="panier.php">
         <table class="responsive-table">
            <tr>
               <td class="center-align" colspan="4"><i class="material-icons">shopping_cart</i><br />Votre panier</td>
            </tr>
            <tr>
               <td>Nom de l'article</td>
               <td>Prix</td>
               <td>Quantité</td>
               <td>Action</td>
            </tr>
            <?php
            if (isset($_GET['deletepanier']) && $_GET['deletepanier'] == true) { // Si on appuie sur deletepanier et deletepanier == true
               // On récupère le ?deletepanier L140 dans l'input et on fait appel à la fonction pour supprimer le panier ENTIER
               supprimePanier();
            }

            if (creationPanier()) {
               $nbProduits = count($_SESSION['panier']['libelleProduit']);

               if ($nbProduits <= 0) {

                  header('location:http://localhost:8888/boutique/index.php');
               } else {

                  for ($i = 0; $i < $nbProduits; $i++) {


            ?>
                     <tr>
                        <td> <?php echo $_SESSION['panier']['libelleProduit'][$i]; ?> </td>

                        <td> <?php echo $_SESSION['panier']['prixProduit'][$i]; ?>€</td>

                        <?php if ($_SESSION['panier']['qteProduit'][$i] > 10) {
                           $_SESSION['panier']['qteProduit'][$i] = 10;
                        }
                        ?>
                        <td> <input class="center-align" name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i]; ?>"> </td>

                        <td> <a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]); ?>">Supprimer</a> </td>
                     </tr>

                  <?php

                  }

                  ?>

                  <tr>
                     <td>
                        <p> Total : <?php echo montantGlobal(); ?> € </p>
                     </td>
                  </tr>

                  <tr>
                     <td>
                        <!-- Valider avec button  -->
                        <input class="btn black" type="submit" value="Modifier" />
                        <!-- Valider avec la touche entrée -->
                     </td>
                     <td>
                        <input type="hidden" name="action" value="refresh" />

                        <a class="btn black" href="?deletepanier=true">Supprimer</a>
                     </td>
                     <td>
                        <form action="panier.php" method="post">
                           <input class="btn black" type="submit" value="Commander" name="envoyerCommande">
                        </form>
                     </td>
                  </tr>
            <?php
               }
            }
            ?>
         </table>
      </form>
   </div>
</main>
<?php

$total = montantGlobal();


require_once('../html_partials/footer.php');
?>
