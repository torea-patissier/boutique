<?php 
session_start();

include ("Classes/index.class.php");
include 'Classes/search_bar.class.php';
$pageIndex = new index;
$pageIndex->Recherche();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css"/>
    <title>Welcome</title>
</head>
<body>
    <header>
        <div class="btn-navigation">
            <div class="barre"></div>
            <div class="barre"></div>
            <div class="barre"></div>
        </div>
        <div class="navigation">
            <ul>
                    <li><a class="navlink" href="index.php">Accueil</a></li>
                    <li><a class="navlink" href="Produit/produit.php">Produits</a></li>
                    <li><a class="navlink" href="Contact/contact.php">Contact</a></li>
                    <li><a class="navlink" href="Qui_sommes_nous/infos.php">Qui sommes nous</a></li>
                    <li><a class="navlink" href="FAQ/faq.php">FAQ</a></li>
                    <li><a class="navlink" href="Inscription/inscription.php">Inscription</a></li>
                    <li><a class="navlink" href="Connexion/connexion.php">Connexion</a></li>
            </ul>
        </div>
    </header>
<main>

    <h1>Welcome to La Petite Boutique</h1>

    <img src="IMG/PackRoulette+Produits/Coffret.jpg" width="1000" height="1000" id="masuperimage" />
 
    <SCRIPT language="JavaScript" type="text/javascript">
    
        // Un tableau qui va contenir toutes tes images.
        var images = new Array();
        images.push("IMG/PackRoulette+Produits/Coffret.jpg");
        images.push("IMG/PackRoulette+Produits/Coffret2.jpg");
        images.push("IMG/PackRoulette+Produits/Coffret3.jpg");
        
        var pointeur = 0;
        
        function ChangerImage(){
        document.getElementById("masuperimage").src = images[pointeur];
        
        if(pointeur < images.length - 1){
        pointeur++;
        }
        else{
        pointeur = 0;
        }
        
        setTimeout("ChangerImage()", 7000)
        }
        
        // Charge la fonction
        window.onload = function(){
        ChangerImage();
        }
    </SCRIPT>
    <h1 class="h1Index">Derniers articles :</h1>
    <div class="lastProducts">
        <?php $pageIndex->lastArticles(); ?>
    </div>
   

</main>

<?php require_once("html_partials/footer.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="app.js"></script>
</body>
</html>