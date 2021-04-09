<?php
session_start();
require_once('../html_partials/header.php');
require_once('../Classes/panier.class.php');
include '../autoloader.php';
$product = new produits;
$erreur = false;
$id = $_SESSION['user']['id'];

echo'<pre>';
// var_dump($_SESSION['user']);
// var_dump($_SESSION['panier']);
// var_dump(date('Y-m-d'));
$total = montantGlobal();
// var_dump($total);
echo'</pre>';

//(?) = alors // (:) = sinon
// Si $POST action existe alors il devient POST sinon et vice versa pour GET
$action = (isset($_POST['action'])? $_POST['action']:(isset($_GET['action'])? $_GET['action']:null )) ;

if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   // Check si les valeurs existent dans un tableau
   
   $erreur=true;

   //récupération des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);

   //On vérifie que $p est un float (chiffre entier ou décimal)
   $p = floatval($p);

      //On traite $q qui peut être un entier simple ou un tableau d'entiers
      if (is_array($q)){
         
         $qteProduit = array();
         $i = 0;

         foreach ($q as $contenu){

            $qteProduit[$i++] = intval($contenu);

         }
      }
      else{

         $q = intval($q);

      }
    
}

if (!$erreur){
   
   switch($action){ // Succession de if par rapport à $action

      Case "ajout":

         ajouterProduit($l,$q,$p);// Nom, quantité, prix du produit
         break;

      Case "suppression":

         supprimerProduit($l);
         break;

      Case "refresh" :

         for ($i = 0 ; $i < count($qteProduit) ; $i++)
         {
            modifierQteProduit($_SESSION['panier']['libelleProduit'][$i],round($qteProduit[$i]));
            //$_SESSION['panier']['libelleProduit'][$i] et round pour arrondir la valeur de la quantité
         }
         break;

      Default:

         break;
   }
}

?>
<main>

<form method="post" action="panier.php">
<table style="width: 400px">
    <tr>
        <td colspan="4">Votre panier</td>
    </tr>
    <tr>
        <td>Nom de l'article</td>
        <td>Prix</td>
        <td>Quantité</td>
        <td>Action</td>
    </tr>


    <?php
    if(isset($_GET['deletepanier']) && $_GET['deletepanier'] == true){ // Si on appuie sur deletepanier et deletepanier == true
      // On récupère le ?deletepanier L140 dans l'input et on fait appel à la fonction pour supprimer le panier ENTIER
      supprimePanier();

    }

    if (creationPanier())
    {
       $nbProduits = count($_SESSION['panier']['libelleProduit']);

       if ($nbProduits <= 0){

         echo"<tr><td>Votre panier est vide </ td></tr>"; // Si le panier est vide, affiché un message

      }else{

         for ($i=0 ;$i < $nbProduits ; $i++){

            
            ?>
               <tr>
                  <td> <?php echo $_SESSION['panier']['libelleProduit'][$i];?> </td><br/>

                  <td> <?php echo $_SESSION['panier']['prixProduit'][$i];?>€</td><br/>
                  
                     <?php if($_SESSION['panier']['qteProduit'][$i] > 10){
                          $_SESSION['panier']['qteProduit'][$i] = 10;
                     }
                     ?>
                  <td> <input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i];?>"> </td><br/>

                  <td> <a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]);?>">Supprimer</a> </td><br/>
               </tr>
               
               <?php
                  $nom_article =  $_SESSION['panier']['libelleProduit'][$i];
                  $qteProduit = $_SESSION['panier']['qteProduit'][$i];
                  // $c = $_SESSION['panier']['prixProduit'][$i];                   
            }

            ?> 

               <tr>
                  <td> <p> Total : <?php echo montantGlobal();?> € </p> </td><br />
               </tr>

               <tr>
                  <td>
                     <!-- Valider avec button  -->
                     <input type="submit" value="rafraichir"/>
                     <!-- Valider avec la touche entrée -->
                     <input type="hidden" name="action" value="refresh"/> 

                     <a href="?deletepanier=true">Supprimer le panier</a>
                  </td>
                  <td>
                     <form action="panier.php" method="post">
                     <input type="submit" name="envoyerCommande">
                     
                        
                     </form>
                     <a href="../Paiement/paiement.php">Payer</a>

                  </td>
               </tr>
            <?php
         
      }
   }
    ?>
</table>
</form>
</main>


<?php

if(isset($_POST['envoyerCommande'])){

   $product->insertcommande($id,$nom_article,$qteProduit);

}

 require_once('../html_partials/footer.php'); ?>