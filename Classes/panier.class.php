<?php

    function creationPanier()
    {
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
            $_SESSION['panier']['libelleProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
            $_SESSION['panier']['verrou'] = false;
        }

        return true;
    }

    function ajouterArticle($libelleProduit, $qteProduit, $prixProduit)
    {
        //SI LE PANIER EXISTE
        if (creationPanier() && !isVerrouille()){

            //SI LE PRODUIT EXISTE DEJA ON AJOUTE SEULEMENT LA QUANTITE
            $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

            if($positionProduit !== false){
                $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;
            }else{
            //SINON ON AJOUTE LE PRODUIT
            array_push($_SESSION['panier']['libelleProduit'], $libelleProduit);
            array_push($_SESSION['panier']['qteProduit'], $qteProduit);
            array_push($_SESSION['panier']['prixProduit'], $prixProduit);
            }
        }else echo "Un probleme est survenu veuillez contacter l'administrateur du site.";

    }

    function supprimerArticle($libelleProduit)
    {
        //SI LE PANIER EXISTE
        if(creationPanier() && !isVerrouille()){

            //ON PASSE PAR UN PANIER TEMPORAIRE
            $tmp = array();
            $tmp['libelleProduit'] = array();
            $tmp['prixProduit'] = array();
            $tmp['verrou'] = $_SESSION['panier']['verrou'];

            for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++ ) {
                
                if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit){

                    array_push( $tmp['libelleProduit'], $_SESSION['panier']['libelleProduit'][$i]);
                    array_push( $tmp['qteProduit'], $_SESSION['panier']['qteProduit'][$i]);
                    array_push( $tmp['prixProduit'], $_SESSION['panier']['prixProduit'][$i]);
                }
            }

            //ON REMPLACE LE PANIER EN SESSION PAR NOTRE PANIER TEMPORAIRE A JOUR
            $_SESSION['panier'] = $tmp;
                //ON EFFANCE NOTRE PANIER TEMPORAIRE
                unset($tmp);
        }else{

            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }
    }

    function modifierQteArticle($libelleProduit, $qteProduit)
    {
        //SI LE PANIER EXISTE
        if(creationPanier() && !isVerrouille())
        {
            //SI LA QUANTITE EST POSITIVE ON MODIFIE SINON ON SUPPRIME L'ARTICLE
            if($qteProduit > 0)
            {
                //RECHERCHE DU PRODUIT DANS LE PANIER
                $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

                    if($positionProduit != false)
                    {
                        $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
                    }
            }else{

                supprimerArticle($libelleProduit);
            }
        }else{

            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }
    }

    function montantGlobal()
    {
        $total = 0;
        
        for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++){

            $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $total;
    }

    function isVerrouille()
    {
        if(isset($_SESSION['panier']) && $_SESSION['panier']['verrou']){
            
            return true;
        }else{
            return false;
        }
    }

    function compterArticles()
    {
        if (isset($_SESSION['panier'])){
            return count($_SESSION['panier']['libelleProduit']);
        }else{
            return 0;
        }
    }

    function supprimerPanier()
    {
        unset($_SESSION['panier']);
    }

?>