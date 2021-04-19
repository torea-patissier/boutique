<?php

/**
 * Verifie si le panier existe, le crée sinon
 * @return booleen
 */ 
function creationPanier(){
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['libelleProduit'] = array();
      $_SESSION['panier']['qteProduit'] = array();
      $_SESSION['panier']['prixProduit'] = array();
      $_SESSION['panier']['idProduit'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}


/**
 * Ajoute un article dans le panier
 * @param string $libelleProduit
 * @param int $qteProduit
 * @param float $prixProduit
 * @return void
 */
function ajouterProduit($libelleProduit,$qteProduit,$prixProduit,$idProduit){

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
         // Var pour définir  la $positionProduit dans un tableau
         $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);

         // Si le produit n'est pas déjà ajouté 
         if ($positionProduit !== false)
         {
            // On incrémente la quantité

               $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;

         }
         else
         {
            //Sinon on ajoute le produit avec array_push
            array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
            array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
            array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
            array_push( $_SESSION['panier']['idProduit'],$idProduit);
         }
   }else{
      echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   }
}



/**
 * Modifie la quantité d'un article
 * @param $libelleProduit
 * @param $qteProduit
 * @return void
 */
function modifierQteProduit($libelleProduit,$qteProduit){
   //Si le panier existe et qu'il n'est pas verrouillé 
   if (creationPanier() && !isVerrouille())
   {
         if ($qteProduit > 0 && $qteProduit > 10)
         {
            echo 'Vous pouvez commander au max 10 fois le même article';

         }if($qteProduit > 0 && $qteProduit <= 10){

            //Recharge la position du produit dans le panier
            $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);
               // Si on trouve le produit
               if ($positionProduit !== false)
               {
                  // On ouvre une session
                  $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
               }

         }else{

            if($qteProduit < 0){

               // Sinon on fait appel à la fonction pour supprimer un article
               supprimerProduit($libelleProduit);

            }
         }

   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

/**
 * Supprime un article du panier
 * @param $libelleProduit
 * @return unknown_type
 */
function supprimerProduit($libelleProduit){
   //Si le panier existe et n'est pas verrouillé
   if (creationPanier() && !isVerrouille())
   {
      //Nous allons passer par un panier temporaire
      $tmp=array();
      $tmp['libelleProduit'] = array();
      $tmp['qteProduit'] = array();
      $tmp['prixProduit'] = array();
      $tmp['idProduit'] = array();
      $tmp['verrou'] = $_SESSION['panier']['verrou'];

      for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
      {
            if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit)
            {
               array_push($tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
               array_push($tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
               array_push($tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
               array_push($tmp['idProduit'],$_SESSION['panier']['idProduit'][$i]);
            }
      }
      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      //On efface notre panier temporaire
      unset($tmp);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   return false;
}


/**
 * Montant total du panier
 * @return int
 */
function MontantGlobal(){

   $total=0; // On initialise une var à 0

   for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
   {
      $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
      // Cette var += quantité d'un produit X prix du ou des produits ajouté dans le panier
   }
   return $total;  // Retourne le résultat
}


/**
 * Fonction de suppression du panier
 * @return void
 */
function supprimePanier()
{
   if(isset($_SESSION['panier'])){ // Si un panier est set

      unset($_SESSION['panier']); // Alors on l'unset
   }
}

/**
 * Permet de savoir si le panier est verrouillé
 * @return booleen
 */
function isVerrouille()
{
   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou']){ // Si un panier et set et si le verrou verrouillé

      return true; 

   }else{

      return false;
   }
}

/**
 * Compte le nombre d'articles différents dans le panier
 * @return int
 */
function compterArticles()
{
   if (isset($_SESSION['panier'])){ // Si un panier est set

      return count($_SESSION['panier']['libelleProduit']); // Retourne le compte de produits

   }else{

      return 0; // Sinon retourne 0 
   }

}

?>   