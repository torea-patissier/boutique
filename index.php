<?php
session_start();
require_once('html_partials/header.index.php');
include 'Classes/index.class.php';
echo '<main>';
$index = new index;
echo'<div class="container">';
$index->Recherche();
echo'</div>';
?>
<div class="row">
    <div class="col s12 ">
        <h1 class="center-align">Notre produit phare : </h1>
        <div class="parallax-container">
            <div class="parallax"><img src="Images/coffret.jpg"></div>
        </div><br />
        <h2 class="center-align">Au sujet de votre croissance ?</h2>
        <h5 class="center-align">
            Le SideKick est un compagnon génial du kit de croissance de la barbe.
            Ces suppléments sont spécifiquement formulés pour nourrir vos follicules
            et soutenir une croissance optimale des cheveux et de la barbe.
            Faites de votre mieux avec The SideKick et The Beard Growth Kit</h5><br />
        <div class="parallax-container">
            <div class="parallax"><img src="Images/coffret2.jpg"></div>
        </div><br />
        <h2 class="center-align">Le rouleau à barbe et l'activateur</h2>
        <h5 class="center-align">
            Les aiguilles en titane 540 créent des canaux microscopiques et activent le
            processus de guérison naturel du corps. Le rouleau à barbe augmente la
            circulation sanguine, stimule les follicules dormants et maximise l'absorption sérique.
            <br /> <br />
            L'activateur contient des ingrédients actifs 100 % naturels, Biotine, Arginine et l'enfant merveilleux,
            Capilia Longa.L'activateur améliorera la croissance de votre barbe avec The Beard Roller.
            Il le fait en créant le meilleur micro-environnement pour réactiver la croissance des cheveux.
        </h5> <br />

        <div class="parallax-container">
            <div class="parallax"><img src="Images/coffret3.jpg"></div>
        </div><br />
    </div>
</div><br /><br /><br />

<h2 class="center-align">Les nouveautés : </h2><br /><br />

<?php
$index->lastArticles();
$index->lastArticles2();
echo '</main>';

require_once('html_partials/footer.index.php');
?>